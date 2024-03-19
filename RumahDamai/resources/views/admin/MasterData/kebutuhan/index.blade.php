@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Data Kebutuhan</h1>

                <!-- Tampilkan notifikasi jika ada -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('kebutuhan.create') }}" class="btn btn-success mb-3">Tambah Jenis Kebutuhan</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th>Nama Kebutuhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kebutuhanList as $kebutuhan)
                            <tr>
                                <td>{{ $kebutuhan->jenis_kebutuhan }}</td>
                                <td>
                                    <a href="{{ route('kebutuhan.show', $kebutuhan->id) }}" class="btn btn-info">Detail</a>
                                    <a href="{{ route('kebutuhan.edit', $kebutuhan->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('kebutuhan.destroy', $kebutuhan->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Tidak ada data Kebutuhan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $kebutuhanList->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
