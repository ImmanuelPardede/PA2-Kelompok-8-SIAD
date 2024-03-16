@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Riwayat Medis</h2>

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('riwayatMedis.create') }}" class="btn btn-success mb-3">Tambah Riwayat Medis</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Riwayat Medis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayatmedisList as $riwayatMedis)
                    <tr>
                        <td>{{ $riwayatMedis->riwayat_perawatan }}</td>
                        <td>
                            <a href="{{ route('riwayatMedis.show', $riwayatMedis->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('riwayatMedis.edit', $riwayatMedis->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('riwayatMedis.destroy', $riwayatMedis->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada Riwayat Medis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
