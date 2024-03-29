@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Jenis Donasi</h2>

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

        <form action="{{ route('donasi.update', $jenisDonasi->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="jenis_donasi">Jenis Donasi:</label>
                <input type="text" class="form-control" name="jenis_donasi" value="{{ old('jenis_donasi', $jenisDonasi->jenis_donasi) }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi', $jenisDonasi->deskripsi) }}</textarea>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
