@extends('layouts.visitors.master')

@section('content')

<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">Fasilitas Kami</h1>
            </div>

        </div>
    </div>
</section>


<section class="section-padding section-bg" id="section_2">
    <div class="container">
        <div class="row">
            @foreach($fasilitas as $item)
            <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                <div class="custom-text-box">
                    <h3>Fasilitas Rumah Damai</h3>
                    <p>{!! $item->fasilitas !!}</p>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="custom-text-box">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($item->detailFasilitas->slice(0, 3) as $index => $detailFasilitas)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset($detailFasilitas->img_fasilitas) }}" class="d-block w-100" alt="..." style="width: 100%; height: auto;">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                </div>
            </div>
            

            @endforeach
        </div>
    </div>
</section>



<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection