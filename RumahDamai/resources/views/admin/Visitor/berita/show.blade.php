@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Berita</h4>
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset($berita->img_berita) }}" alt="Gambar Berita" style="width: 500px; height: auto;">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th for="judul">Judul:</th>
                                        <td>{{ $berita->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori:</th>
                                        <td>{{ $berita->kategori->kategori }}</td>
                                    </tr>
                                    <tr>
                                        <th for="deskripsi">Deskripsi:</th>
                                        <td>{!! $berita->deskripsi !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
