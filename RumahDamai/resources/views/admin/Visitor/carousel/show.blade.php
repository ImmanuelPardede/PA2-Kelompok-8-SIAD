@extends('layouts.management.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Carousel Detail</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Judul:</strong>
                <p>{{ $carouselItem->caption }}</p>
            </div>
            <div class="mb-3">
                <strong>SubJudul:</strong>
                <p>{{ $carouselItem->subcaption }}</p>
            </div>
            @if ($carouselItem->image_url)
            <div class="mb-3">
                <strong>Gambar:</strong>
                <img src="{{ asset($carouselItem->image_url) }}" alt="Carousel Image" style="max-width: 300px;">
            </div>
            @endif
            <div class="mt-4">
                <a href="{{ route('carousel.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
