@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Lokasi Penugasan</h2>

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('lokasiTugas.create') }}" class="btn btn-success mb-3">Tambah Lokasi Penugasan</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Wilayah</th>
                    <th>Nama Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lokasiList as $lokasi)
                    <tr>
                        <td>{{ $lokasi->lokasi_penugasan_id }}</td>
                        <td>{{ $lokasi->wilayah }}</td>
                        <td>{{ $lokasi->lokasi }}</td>
                        <td>
                            <a href="{{ route('lokasiTugas.show', $lokasi->lokasi_penugasan_id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('lokasiTugas.edit', $lokasi->lokasi_penugasan_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('lokasiTugas.destroy', $lokasi->lokasi_penugasan_id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data Lokasi Penugasan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
