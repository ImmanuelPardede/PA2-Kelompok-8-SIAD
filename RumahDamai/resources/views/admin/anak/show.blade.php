{{-- resources/views/admin/anak/show.blade.php --}}

@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Anak</h2>

        <p><strong>ID:</strong> {{ $anak->id }}</p>
        <p><strong>Nama Lengkap:</strong> {{ $anak->namaLengkap }}</p>
        <p><strong>Tempat Lahir:</strong> {{ $anak->tempatLahir }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ $anak->tanggalLahir }}</p>

        <a href="{{ route('anak.edit', $anak->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('anak.destroy', $anak->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>
@endsection
