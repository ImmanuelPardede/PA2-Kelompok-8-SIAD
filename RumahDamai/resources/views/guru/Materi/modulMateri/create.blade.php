@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Modul Materi</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('modulMateri.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kelas_id">Nama Kelas<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="kelas_id" name="kelas_id" >
                            <option value="" disabled selected>-- Nama Kelas--</option>
                            @foreach ($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_materi">Nama Materi<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="nama_materi" name="nama_materi" >
                    </div>

                    <div class="form-group">
                        <label for="minggu_pembelajaran_id">Minggu Pembelajaran<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="minggu_pembelajaran_id"
                            name="minggu_pembelajaran_id" >
                            <option value="" disabled selected>-- Minggu Pembelajaran--</option>
                            @foreach ($mingguPembelajaran as $mingguPembelajaranItem)
                                <option value="{{ $mingguPembelajaranItem->id }}">
                                    {{ $mingguPembelajaranItem->minggu_pembelajaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file_modul">File Modul<span style="color: red">*</span></label>
                        <input type="file" class="form-control" name="file_modul" >
                        <small class="text-muted">Jenis file yang diizinkan: PDF, DOC, DOCX.</small>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="editor1" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                            autocomplete="deskripsi">
                            <ol><li></li></ol>{{ old('deskripsi') }}
                        </textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>
