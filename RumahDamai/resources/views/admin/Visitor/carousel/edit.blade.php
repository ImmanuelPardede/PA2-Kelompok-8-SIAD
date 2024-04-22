@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Carousel Item</h1>

            <!-- Form untuk mengupdate carousel item -->
            <form method="POST" action="{{ route('carousel.update', $carousel->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input untuk caption -->
                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
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
                <button type="submit" class="btn btn-primary">Update Carousel Item</button>
            </form>
        </div>
    </div>
</div>
@endsection
