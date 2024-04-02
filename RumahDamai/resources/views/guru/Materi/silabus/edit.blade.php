@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Silabus</h2>

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

        <form action="{{ route('silabus.update', $silabus->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kelas_id">Nama Kelas:</label>
                <input type="text" class="form-control" name="kelas_id" value="{{ old('kelas_id', $silabus->kelas_id) }}">
            </div>

            <div class="form-group">
                <label for="nama_silabus">Nama Silabus</label>
                <input type="text" class="form-control" id="nama_silabus" name="nama_silabus" value="{{ old('nama_silabus', $silabus->nama_silabus) }}">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $silabus->deskripsi) }}</textarea>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
