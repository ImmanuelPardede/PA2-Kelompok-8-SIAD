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
                    <h1 class="card-title">Format PPI Bagian A</h1>
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
                            <div>{{ $ppiA->anak->nama_lengkap }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">Nomor Induk Anak</div>
                            <div>{{ $ppiA->anak->nia }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">Tanggal Lahir</div>
                            <div>{{ $ppiA->anak->tanggal_lahir }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">Jenis Kelamin</div>
                            <div>{{ $ppiA->anak->jenisKelamin->jenis_kelamin }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">Alamat</div>
                            <div>{{ $ppiA->anak->alamat }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">Tanggal Penyusunan</div>
                            <div>{{ $ppiA->created_at }}</div>
                        </div>
                    </div>
                </div>
                <hr>

                <h6 class="card-subtitle mb-2 text-muted">Detail PPI:</h6>
                <hr>
                @foreach ($detailppi as $index => $ppi)
                    <div class="detail-ppi-section">
                        <div class="ppi-item">
                            <h3><b>Level Komunikasi</b></h3>
                            <p>{!! $ppi->level_komunikasi !!}</p>
                        </div>
                        <hr>
                        <div class="ppi-item">
                            <h3><b>Gambaran Sensorik & Lainnya</b></h3>
                            <p>{!! $ppi->gambaran_sensorik !!}</p>
                        </div>
                        <hr>
                        <div class="ppi-item">
                            <h3><b>Informasi Penting Tentang Anak</b></h3>
                            <p>{!! $ppi->informasi_penting !!}</p>
                        </div>
                        <hr>
                        <div class="ppi-item">
                            <h3><b>Kondisi Lain yang Berhubungan dengan Anak</b></h3>
                            <p>{!! $ppi->kondisi_lain !!}</p>
                        </div>
                        <hr>
                        <div class="ppi-item">
                            <h3><b>Layanan Lain yang Sebaiknya Diberikan</b></h3>
                            <p>{!! $ppi->layanan_lain !!}</p>
                        </div>
                        <hr>
                        <div class="ppi-item">
                            <h3><b>Tujuan Jangka Panjang (Mimpi Tiga atau Lima Tahun yang Akan Datang)</b></h3>
                            <p>{!! $ppi->tujuan_jangka_panjang !!}</p>
                        </div>
                        <hr>
                        <div class="ppi-item">
                            <h3><b>Tujuan Jangka Pendek (Satu Tahun)</b></h3>
                            <p>{!! $ppi->tujuan_jangka_pendek !!}</p>
                        </div>
                    </div>
                @endforeach

                <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                <a href="{{ route('ppiA.pdf', $ppiA->id) }}" class="btn btn-success">Download PDF</a>
            </div>
        </div>
    </div>
@endsection
