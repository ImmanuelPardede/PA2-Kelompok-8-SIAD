@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-left">Form Menambah Fasilitas</h1>

                <form method="POST" action="{{ route('admin.fasilitas.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="img_fasilitas" class="form-label">Gambar<span style="color: red">*</span></label>
                        <input type="file" class="form-control" id="img_fasilitas" name="img_fasilitas[]"
                            accept="image/*" multiple required>
                            <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                        <small class="text-muted" id="wordCountInfo">Maksimal 10 Gambar.</small>
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label">fasilitas<span style="color: red">*</span></label>
                        <textarea id="editor1" class="form-control @error('fasilitas') is-invalid @enderror" name="fasilitas" required
                            autocomplete="fasilitas">
                        {{ old('fasilitas') }}
                        <ul>
                            <li></li>
                        </ul>
                    </textarea>
                        @error('fasilitas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
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
