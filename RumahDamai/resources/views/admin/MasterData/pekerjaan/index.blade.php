@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Jenis Pekerjaan</h2>

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('pekerjaan.create') }}" class="btn btn-success mb-3">Tambah Jenis Pekerjaan</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Pekerjaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pekerjaanList as $pekerjaan)
                    <tr>
                        <td>{{ $pekerjaan->id }}</td>
                        <td>{{ $pekerjaan->jenis_pekerjaan }}</td>
                        <td>
                            <a href="{{ route('pekerjaan.show', $pekerjaan->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('pekerjaan.edit', $pekerjaan->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pekerjaan.destroy', $pekerjaan->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data Jenis Pekerjaan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
