@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Lokasi Penugasan</h1>

                <!-- Tampilkan notifikasi jika ada -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('lokasiTugas.create') }}" class="btn btn-success mb-3">Tambah Lokasi Penugasan</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th>Nama Wilayah</th>
                            <th>Nama Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lokasiList as $lokasi)
                            <tr>
                                <td>{{ $lokasi->wilayah }}</td>
                                <td>{{ $lokasi->lokasi }}</td>
                                <td>
                                    <a href="{{ route('lokasiTugas.show', $lokasi->id) }}" class="btn btn-info">Detail</a>
                                    <a href="{{ route('lokasiTugas.edit', $lokasi->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('lokasiTugas.destroy', $lokasi->id) }}" method="post" style="display:inline;">
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
        </div>
    </div>
</div>
@endsection
