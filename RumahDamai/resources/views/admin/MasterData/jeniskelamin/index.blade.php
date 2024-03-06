@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Data Kelamin</h2>

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('jenisKelamin.create') }}" class="btn btn-success mb-3">Tambah Jenis Kelamin</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jenisKelaminList as $kelamin)
                    <tr>
                        <td>{{ $kelamin->id }}</td>
                        <td>{{ $kelamin->jenis_kelamin }}</td>
                        <td>
                            <a href="{{ route('jenisKelamin.show', $kelamin->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('jenisKelamin.edit', $kelamin->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('jenisKelamin.destroy', $kelamin->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data kelamin.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
