@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Jenis Sponsorship</h2>

        <!-- Tampilkan notifikasi jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('sponsorship.create') }}" class="btn btn-success mb-3">Tambah Jenis Sponsorship</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Jenis Sponsorship</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sponsorshipList as $sponsorship)
                    <tr>
                        <td>{{ $sponsorship->jenis_sponsorship }}</td>
                        <td>
                            <a href="{{ route('sponsorship.show', $sponsorship->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('sponsorship.edit', $sponsorship->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('sponsorship.destroy', $sponsorship->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada Jenis Sponsorship.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
