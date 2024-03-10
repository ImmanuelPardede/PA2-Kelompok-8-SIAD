@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Data Golongan Darah</h2>

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('golonganDarah.create') }}" class="btn btn-success mb-3">Tambah Jenis Golongan Darah</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Golongan Darah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($golonganDarahList as $darah)
                    <tr>
                        <td>{{ $darah->golongan_darah }}</td>
                        <td>
                            <a href="{{ route('golonganDarah.edit', $darah->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('golonganDarah.destroy', $darah->id) }}" method="post" style="display:inline;">
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
