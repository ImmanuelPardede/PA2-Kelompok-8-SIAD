@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Galeri</h4>
                <div class="d-flex justify-content-center mb-4">
                    @foreach ($detailgaleri as $detail)
                        <img src="{{ asset($detail->img_galeri) }}" alt="Gambar galeri" class="img-fluid" style="width: 500px; height: auto;">
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Judul</th>
                                        <td>{{ $galeri->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <td>{{ $galeri->lokasi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu:</th>
                                        <td>{{ $galeri->waktu }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
