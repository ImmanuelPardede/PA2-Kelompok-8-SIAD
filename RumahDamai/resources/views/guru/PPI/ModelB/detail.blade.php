@extends('layouts.management.master')

@section('content')
    <style>
        /* Custom styles for the layout */
        .info-card {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .info-card .title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .info-card div {
            font-size: 14px;
        }

        .card-title,
        .card-subtitle {
            color: #2c3e50;
        }

        .detail-ppi-section {
            margin-bottom: 20px;
        }

        .ppi-item {
            margin-bottom: 10px;
        }

        .ppi-item h3 {
            font-size: 16px;
            color: #2c3e50;
        }

        .ppi-item p {
            font-size: 14px;
            color: #555;
        }

        hr {
            border: 0;
            border-top: 1px solid #ddd;
        }
    </style>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h1 class="card-title">Format PPI Bagian B</h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="info-card">
                        <div class="title">Nama Lengkap</div>
                        <div>{{ $ppiB->anak->nama_lengkap }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-card">
                        <div class="title">Nomor Induk Anak</div>
                        <div>{{ $ppiB->anak->nia }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-card">
                        <div class="title">Tanggal Lahir</div>
                        <div>{{ \Carbon\Carbon::parse($ppiB->anak->tanggal_lahir)->format('d-m-Y') }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-card">
                        <div class="title">Jenis Kelamin</div>
                        <div>{{ $ppiB->anak->jenisKelamin->jenis_kelamin }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-card">
                        <div class="title">Alamat</div>
                        <div>{{ $ppiB->anak->alamat }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-card">
                        <div class="title">Tanggal Penyusunan</div>
                        <div>{{ \Carbon\Carbon::parse($ppiB->created_at)->format('d-m-Y') }}</div>
                    </div>
                </div>
            </div>
            <hr>

            <h6 class="card-subtitle mb-2 text-muted">Detail PPI:</h6>
            <hr>
            @foreach ($detailppi as $index => $ppi)
                <div class="detail-ppi-section">
                    <div class="ppi-item">
                        <h3><b>File PPI B</b></h3>
                        <p>
                            <a href="{{ asset('uploads/ppiB_files/' . $ppi->file_ppi_b) }}" target="_blank">
                                {{ $ppi->file_ppi_b }}
                            </a>
                        </p>
                    </div>
                    <hr>
                    <div class="ppi-item">
                        <h3><b>Deskripsi</b></h3>
                        <p>{!! $ppi->deskripsi !!}</p>
                    </div>
                </div>
            @endforeach

            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>

@endsection
