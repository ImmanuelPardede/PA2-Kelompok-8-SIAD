@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Lokasi Penugasan</h2>

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

        <form action="{{ route('lokasiTugas.update', $lokasiPenugasan->lokasi_penugasan_id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="wilayah">Wilayah:</label>
                <input type="text" class="form-control" name="wilayah" value="{{ old('wilayah', $lokasiPenugasan->wilayah) }}" required>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi:</label>
                <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi', $lokasiPenugasan->lokasi) }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi', $lokasiPenugasan->deskripsi) }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
