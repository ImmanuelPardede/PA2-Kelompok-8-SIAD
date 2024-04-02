@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Tahun Kurikulum</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('tahunKurikulum.create') }}" class="btn btn-success mb-3">Tambah Tahun Kurikulum</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th>Tahun Kurikulum</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tahunKurikulumList as $tahunKurikulum)
                            <tr>
                                <td>{{ $tahunKurikulum->tahun_kurikulum }}</td>
                                <td>
                                    <a href="{{ route('tahunKurikulum.edit', $tahunKurikulum->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('tahunKurikulum.destroy', $tahunKurikulum->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="number" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Tidak ada data Tahun Kurikulum.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $tahunKurikulumList->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
