@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Carousel Detail</h1>

                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table" style="max-width: 100%;">
                                <tbody>
                                    <tr>
                                        <th>Judul:</th>
                                        <td>{{ $carouselItem->caption }}</td>
                                    </tr>
                                    <tr>
                                        <th>SubJudul:</th>
                                        <td>{{ $carouselItem->subcaption }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="image-container">
                            <div class="image-frame">
                                @if ($carouselItem->image_url)
                                    <div class="mb-3">
                                        <strong>Gambar:</strong>
                                        <img src="{{ asset($carouselItem->image_url) }}" alt="Carousel Image"
                                            style="max-width: 300px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
