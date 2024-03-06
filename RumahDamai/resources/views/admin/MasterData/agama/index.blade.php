@extends('layouts.master')

@section('content')
    <div class="container">

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="card-title">Data Agama</h1>
            <a href="{{ route('agama.create') }}" class="btn btn-success mb-3">Tambah Agama</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Agama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agamaList as $agama)
                    <tr>
                        <td>{{ $agama->id }}</td>
                        <td>{{ $agama->agama }}</td>
                        <td>
                            <a href="{{ route('agama.show', $agama->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('agama.edit', $agama->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('agama.destroy', $agama->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data agama.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
