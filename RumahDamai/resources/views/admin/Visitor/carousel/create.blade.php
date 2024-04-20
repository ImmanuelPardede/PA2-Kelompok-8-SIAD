@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Add New Carousel Item</h1>

            <!-- Form untuk menambahkan carousel item -->
            <form method="POST" action="{{ route('carousel.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="image_url" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image_url" name="image_url" accept="image_url/*" required>
                </div>

                <!-- Input untuk caption -->
                <div class="mb-3">
                    <label for="caption" class="form-label">Caption (Max 15 characters)</label>
                    <input type="text" class="form-control" id="caption" name="caption" placeholder="Enter caption" maxlength="15">
                </div>
                

                <!-- Input untuk subcaption -->
                <div class="mb-3">
                    <label for="subcaption" class="form-label">Subcaption</label>
                    <input type="text" class="form-control" id="subcaption" name="subcaption" placeholder="Enter subcaption" maxlength="52">
                </div>

                <!-- Tombol untuk submit form -->
                <button type="submit" class="btn btn-primary">Add Carousel Item</button>
            </form>
        </div>
    </div>
</div>
@endsection
