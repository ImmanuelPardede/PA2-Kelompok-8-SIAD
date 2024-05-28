@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-title text-left">Edit Pengumuman</div>

                <form action="{{ route('direktur.pengumuman.update', ['id' => $pengumuman->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input id="judul" type="text" class="form-control" name="judul"
                            value="{{ $pengumuman->judul }}" autofocus>
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="editor1" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required
                            autocomplete="deskripsi">{{ old('deskripsi', $pengumuman->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input id="kategori" type="text" class="form-control" name="kategori"
                            value="{{ $pengumuman->kategori }}">
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali</a>
                    <button type="submit" id="submitButton" class="btn btn-success mr-2"
                        onclick="handleUpdatedConfirmation(event)">Perbaharui Pengumuman</button>
                </form>
            </div>
        </div>
    </div>

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
@endsection
