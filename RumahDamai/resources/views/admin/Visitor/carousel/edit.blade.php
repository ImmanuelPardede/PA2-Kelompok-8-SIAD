@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Carousel Item</h1>
            <h1 class="display-5 font-weight-bold text-left">Edit Data Carousel</h1>

            <!-- Form untuk mengupdate carousel item -->
            <form method="POST" action="{{ route('admin.carousel.update', $carousel->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input untuk caption -->
                <div class="mb-3">
                    <label for="caption" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="caption" name="caption" value="{{ $carousel->caption }}" placeholder="Enter caption" maxlength="50">
                </div>

                <!-- Input untuk subcaption -->
                <div class="mb-3">
                    <label for="subcaption" class="form-label">Subcaption (Max 50 characters)</label>
                    <input type="text" class="form-control" id="subcaption" name="subcaption" value="{{ $carousel->subcaption }}" placeholder="Enter subcaption" maxlength="52">
                </div>


                <!-- Input untuk gambar -->
                <div class="mb-3">
                    <label for="image_url" class="form-label">New Image</label>
                    <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*">
                </div>

                <!-- Tampilkan gambar saat ini -->
                @if ($carousel->image_url)
                    <div class="mb-3">
                        <label for="current_image" class="form-label">Current Image</label>
                        <img src="{{ asset($carousel->image_url) }}" alt="Current Image" style="max-width: 300px;">
                    </div>
                @endif

                <!-- Tombol untuk submit form -->
                <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                <button type="submit" id="submitButton" class="btn btn-success mr-2" onclick="handleUpdatedConfirmation(event)">Perbaharui</button>
            </form>
        </div>
    </div>
</div>
@endsection
