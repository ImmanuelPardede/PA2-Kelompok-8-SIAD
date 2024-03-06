@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Data Kebutuhan</h2>

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('kebutuhan.create') }}" class="btn btn-success mb-3">Tambah Jenis Kebutuhan</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kebutuhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kebutuhanList as $kebutuhan)
                    <tr>
                        <td>{{ $kebutuhan->id }}</td>
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
@endsection
