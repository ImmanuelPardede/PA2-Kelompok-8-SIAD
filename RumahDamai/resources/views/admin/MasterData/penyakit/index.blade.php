@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Jenis Penyakit</h1>

                <!-- Tampilkan notifikasi jika ada -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('penyakit.create') }}" class="btn btn-success mb-3">Tambah Jenis Penyakit</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th>Jenis Penyakit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penyakitList as $penyakit)
                            <tr>
                                <td>{{ $penyakit->jenis_penyakit }}</td>
                                <td>
                                    <a href="{{ route('penyakit.show', $penyakit->id) }}" class="btn btn-info">Detail</a>
                                    <a href="{{ route('penyakit.edit', $penyakit->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('penyakit.destroy', $penyakit->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Tidak ada Jenis Penyakit.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
