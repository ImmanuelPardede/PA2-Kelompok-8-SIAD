@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Modul Materi</h2>
        <form action="{{ route('modulMateri.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="kelas_id">Nama Kelas</label>
                <select class="form-control js-example-basic-single" id="kelas_id" name="kelas_id">
                    @foreach ($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama_materi">Nama Materi</label>
                <input type="text" class="form-control" id="nama_materi" name="nama_materi">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
            </div>

            <input type="hidden" name="guru_id" value="{{ auth()->user()->id }}">

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
