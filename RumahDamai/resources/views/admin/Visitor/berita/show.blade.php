@extends('layouts.management.master')

@section('content')

<div class="container">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-title text-left">Detail Berita</div>
                <div class="form-group">
                    <label for="judul">Judul:</label>
                    <p>{{ $berita->judul }}</p>
                </div>

                <div class="form-group">
                    <label for="kategori_id">Kategori:</label>
                    <p>{{ $berita->kategori->kategori }}</p>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <p>{!! $berita->deskripsi !!}</p>
                </div>

                <div class="form-group">
                    <label for="img_berita">Gambar:</label>
                    <img src="{{ asset($berita->img_berita) }}" alt="Gambar Berita">
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
