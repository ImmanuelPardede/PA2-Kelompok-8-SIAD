@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Silabus</h2>
        <form action="{{ route('silabus.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="kelas_id">Nama Kelas</label>
                <select class="form-control js-example-basic-single" id="kelas_id" name="kelas_id">
                    @foreach ($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="tahun_kurikulum_id" value="{{ $tahun_kurikulum_id }}">
            </div>

            <div class="form-group">
                <label for="nama_silabus">Nama Silabus</label>
                <input type="text" class="form-control" id="nama_silabus" name="nama_silabus">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
