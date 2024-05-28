@extends('layouts.management.master')

@section('content')
<div class="container">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-title text-left">Form Menambah Tentang Yayasan</div>

                    <form method="POST" action="{{ route('admin.about.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Input for img_yayasan -->
                        <div class="form-group">
                            <label for="img_yayasan">Gambar Yayasan <span style="color: red">*</span></label>
                            <input id="img_yayasan" type="file" class="form-control @error('img_yayasan') is-invalid @enderror" name="img_yayasan" required accept="image/*">
                            @error('img_yayasan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Input for latar_belakang -->
                        <div class="form-group">
                            <label for="latar_belakang">Latar Belakang Yayasan <span style="color: red">*</span></label>
                            <textarea id="latar_belakang" class="form-control @error('latar_belakang') is-invalid @enderror" name="latar_belakang" rows="4">{{ old('latar_belakang') }}</textarea>
                            @error('latar_belakang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                        <!-- Input for visi -->
                        <div class="form-group">
                            <label for="visi">Visi <span style="color: red">*</span></label>
                            <textarea id="visi" class="form-control @error('visi') is-invalid @enderror" name="visi" rows="4">{{ old('visi') }}</textarea>
                            @error('visi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
                        <div class="form-group">
                            <label for="misi" class="form-label">Misi<span style="color: red">*</span></label>
                            <textarea id="editor1" class="form-control @error('misi') is-invalid @enderror" name="misi" required autocomplete="misi">
                                <ul>
                                    <li>..</li>
                                </ul>
                                {{ old('misi') }}
                            </textarea>
                            @error('misi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Input for misi -->

<hr>

                        <!-- Input for wilayah1 -->
                        <div class="form-group">
                            <label for="wilayah1">Deskripsi Wilayah 1 <span style="color: red">*</span></label>
                            <input id="wilayah1" type="text" class="form-control @error('wilayah1') is-invalid @enderror" name="wilayah1" value="{{ old('wilayah1') }}">
                            @error('wilayah1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Input for img_wilayah1 -->
                        <div class="form-group">
                            <label for="img_wilayah1">Gambar Wilayah 1 <span style="color: red">*</span></label>
                            <input id="img_wilayah1" type="file" class="form-control @error('img_wilayah1') is-invalid @enderror" name="img_wilayah1" required accept="image/*">
                            @error('img_wilayah1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <hr>
                        <!-- Input for wilayah2 -->
                        <div class="form-group">
                            <label for="wilayah2">Deskripsi Wilayah 2 <span style="color: red">*</span></label>
                            <input id="wilayah2" type="text" class="form-control @error('wilayah2') is-invalid @enderror" name="wilayah2" value="{{ old('wilayah2') }}">
                            @error('wilayah2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Input for img_wilayah2 -->
                        <div class="form-group">
                            <label for="img_wilayah2">Gambar Wilayah 2 <span style="color: red">*</span></label>
                            <input id="img_wilayah2" type="file" class="form-control @error('img_wilayah2') is-invalid @enderror" name="img_wilayah2" required accept="image/*">
                            @error('img_wilayah2')
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
</div>
@endsection


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
