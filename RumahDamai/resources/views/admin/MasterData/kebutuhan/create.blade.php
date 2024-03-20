@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Kebutuhan</h2>

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

        <form action="{{ route('kebutuhan.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="jenis_kebutuhan">Nama Kebutuhan:</label>
                <input type="text" class="form-control" name="jenis_kebutuhan" value="{{ old('jenis_kebutuhan') }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
