@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Fasilitas</h4>
                <div class="d-flex justify-content-center mb-4">
                    @foreach ($detailFasilitas as $detail)
                        <div class="image-frame">
                            <img src="{{ asset($detail->img_fasilitas) }}" alt="Gambar Fasilitas"
                                style="width: 500px; height: auto;">
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Fasilitas</th>
                                        <td>{!! $fasilitas->fasilitas ?? 'Data tidak tersedia' !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-primary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
