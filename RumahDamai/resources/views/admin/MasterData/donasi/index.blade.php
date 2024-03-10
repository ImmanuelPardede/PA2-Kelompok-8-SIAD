@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Jenis Donasi</h2>

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('donasi.create') }}" class="btn btn-success mb-3">Tambah Jenis Donasi</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Jenis Donasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donasiList as $donasi)
                    <tr>
                        <td>{{ $donasi->jenis_donasi }}</td>
                        <td>
                            <a href="{{ route('donasi.show', $donasi->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('donasi.edit', $donasi->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('donasi.destroy', $donasi->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada Jenis Donasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
