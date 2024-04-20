@extends('layouts.visitors.master')

@section('content')

<section class="hero-section hero-section-full-height">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-12 p-0">
                <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('kind/images/slide/volunteer-helping-with-donation-box.jpg')}}"
                                class="carousel-image img-fluid" alt="...">
                            <div class="carousel-caption d-flex flex-column justify-content-end">
                                <h1>be a Kind Heart</h1>

                                <p>Professional charity theme based on Bootstrap 5.2.2</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('kind/images/slide/volunteer-selecting-organizing-clothes-donations-charity.jpg')}}"
                            
                                class="carousel-image img-fluid" alt="...">

                            <div class="carousel-caption d-flex flex-column justify-content-end">
                                <h1>Non-profit</h1>

                                <p>You can support us to grow more</p>
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#hero-slide"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-12 text-center mx-auto">
                <h2 class="mb-5">Welcome to Kind Heart Charity</h2>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="donate.html" class="d-block">
                        <img src="{{ asset('kind/images/icons/hands.png')}}" class="featured-block-image img-fluid" alt="">
                        
                        <p class="featured-block-text">Become a <strong>volunteer</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="donate.html" class="d-block">
                        <img src="{{ asset('kind/images/icons/heart.png')}}" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text"><strong>Caring</strong> Earth</p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="donate.html" class="d-block">
                        <img src="{{ asset('kind/images/icons/receive.png')}}" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text">Make a <strong>Donation</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="donate.html" class="d-block">
                        <img src="{{ asset('kind/images/icons/scholarship.png')}}" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text"><strong>Scholarship</strong> Program</p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
