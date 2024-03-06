@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Lokasi Penugasan</h2>

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

        <form action="{{ route('lokasiTugas.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="lokasi_penugasan">Lokasi Penugasan:</label>
                <input type="text" class="form-control" name="lokasi_penugasan" value="{{ old('lokasi_penugasan') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
