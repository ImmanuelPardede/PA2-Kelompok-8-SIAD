@extends('layouts.visitors.master')

@section('content')

<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">Detail Berita Kami</h1>
            </div>

        </div>
    </div>
</section>


<section class="news-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 col-12">
                <div class="news-block">
                    <div class="news-block-top">
                        <img src="{{ asset($berita->img_berita) }}" class="news-image img-fluid" alt="">

                        <div class="news-category-block">
                            <a href="#" class="category-block-link">{{ $berita->kategori->kategori }}</a>
                        </div>
                    </div>

                    <div class="news-block-info">
                        <div class="d-flex mt-2">
                            <div class="news-block-date">
                                <p>
                                    <i class="bi-calendar4 custom-icon me-1"></i>
                                    {{ $berita->created_at }}                                </p>
                            </div>

                            <div class="news-block-author mx-5">
                                <p>
                                    <i class="bi-person custom-icon me-1"></i>
                                    By Admin
                                </p>
                            </div>
                        </div>

                        <div class="news-block-title mb-2">
                            <h4>{{ $berita->judul }}</h4>
                        </div>

                        <div class="news-block-body">
                            <p>{!! $berita->deskripsi !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0">
                <form class="custom-form search-form" action="#" method="post" role="form">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">

                    <button type="submit" class="form-control">
                        <i class="bi-search"></i>
                    </button>
                </form>

                <h5 class="mt-5 mb-3">Recent news</h5>

                @foreach ($recentNews as $item)
                <div class="news-block news-block-two-col d-flex mt-4">
                    <div class="news-block-two-col-image-wrap">
                        <a href="{{ route('news.detail', ['id' => $item->id]) }}">
                            <img src="{{ asset($item->img_berita) }}" class="news-image img-fluid" alt="">
                        </a>
                    </div>

                    <div class="news-block-two-col-info">
                        <div class="news-block-title mb-2">
                            <h6><a href="{{ route('news.detail', ['id' => $item->id]) }}" class="news-block-title-link">{{ $item->judul }}</a></h6>
                        </div>

                        <div class="news-block-date">
                            <p>
                                <i class="bi-calendar4 custom-icon me-1"></i>
                                {{ $item->created_at }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="tags-block">
                    <h5 class="mb-3">Tags</h5>
                    @foreach($kategori as $item)
                    @php
                        // Menghitung jumlah berita yang memiliki kategori_id yang sesuai
                        $jumlah_berita = $berita->where('kategori_id', $item->id)->count();
                    @endphp
                    <a href="#" class="tags-block-link">
                        {{ $item->kategori }}
                        <span class="badge">{{ $jumlah_berita }}</span>
                    </a>
                @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

@endsection