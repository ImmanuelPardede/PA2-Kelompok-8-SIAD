@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="display-5 font-weight-bold text-left mb-3">Form Menambah Carousel</h1>

            <!-- Form untuk menambahkan carousel item -->
            <form method="POST" action="{{ route('admin.carousel.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="image_url" class="form-label">Gambar<span style="color: red">*</span></label>
                    <input type="file" class="form-control" id="image_url" name="image_url" accept="image_url/*" required>
                    <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                </div>

                <!-- Input untuk caption -->
                <div class="mb-3">
                    <label for="caption" class="form-label">Judul<span style="color: red">*</span></label>
                    <input type="text" class="form-control" id="caption" name="caption" placeholder="Enter caption" maxlength="15">
                    <small class="text-muted" id="wordCountInfo">Maksimal 15 Huruf.</small>
                </div>


                <!-- Input untuk subcaption -->
                <div class="mb-3">
                    <label for="subcaption" class="form-label">Subjudul<span style="color: red">*</span></label>
                    <input type="text" class="form-control" id="subcaption" name="subcaption" placeholder="Enter subcaption" maxlength="52">
                    <small class="text-muted" id="wordCountInfo">Maksimal 52 Huruf.</small>
                </div>

                <!-- Tombol untuk submit form -->
                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
