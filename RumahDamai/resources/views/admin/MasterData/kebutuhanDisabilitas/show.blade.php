@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Jenis Kebutuhan Disabilitas</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Jenis Kebutuhan</th>
                                        <td>{{ $kebutuhanDisabilitas->jenis_kebutuhan_disabilitas }}</td>
                                        <strong>Deskripsi</strong>
                                        {{ $kebutuhanDisabilitas->deskripsi ?? 'Data tidak tersedia' }}
                        </div>

                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    </div>
                @endsection
            </div>
        </div>
    </div>

