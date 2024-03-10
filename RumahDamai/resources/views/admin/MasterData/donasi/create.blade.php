@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Jenis Donasi</h2>

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

        <form action="{{ route('donasi.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="jenis_donasi">Jenis Donasi:</label>
                <input type="text" class="form-control" name="jenis_donasi" value="{{ old('jenis_donasi') }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
