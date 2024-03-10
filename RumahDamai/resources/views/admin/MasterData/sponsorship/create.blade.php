@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Jenis Sponsorship</h2>

        <!-- Tampilkan pesan kesalahan validasi jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sponsorship.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="jenis_sponsorship">Jenis Sponsorship:</label>
                <input type="text" class="form-control" name="jenis_sponsorship" value="{{ old('jenis_sponsorship') }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
