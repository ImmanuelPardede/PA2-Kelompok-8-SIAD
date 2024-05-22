@extends('layouts.management.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Format PPI Bagian A</h2>
            <div class="table">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Nama Lengkap :</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $ppiA->anak->nama_lengkap }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Nomor Induk Anak :</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $ppiA->anak->nia }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Tanggal lahir :</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $ppiA->anak->tanggal_lahir }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Jenis Kelamin :</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $ppiA->anak->jenisKelamin->jenis_kelamin }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Alamat :</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $ppiA->anak->alamat }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Tgl penyusunan :</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $ppiA->created_at }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <h6 class="card-subtitle mb-2 text-muted">Detail PPI:</h6>
            @foreach ($detailppi as $index => $ppi)
            <ul>
                <li>
                    <h3><b>Level Komunikasi</b></h3>
                    <p>{!! $ppi->level_komunikasi !!}</p>
                </li>
                <hr>
                <li>
                    <h3><b>Gambaran sensory & lainnya</b></h3>
                    <p>{!! $ppi->gambaran_sensorik !!}</p>
                </li>
                <hr>
                <li>
                    <h3><b>Informasi penting tentang anak</b></h3>
                    <p>{!! $ppi->informasi_penting !!}</p>
                </li>
                <hr>
                <li>
                    <h3><b>Kondisi lain yang berhubungan dengan anak</b></h3>
                    <p>{!! $ppi->kondisi_lain !!}</p>
                </li>
                <hr>
                <li>
                    <h3><b>Layanan lain yang sebaiknya diberikan</b></h3>
                    <p>{!! $ppi->layanan_lain !!}</p>
                </li>
                <hr>
                <li>
                    <h3><b>Tujuan Jangka Panjang (mimpi tiga atau lima tahun yang akan datang)</b></h3>
                    <p>{!! $ppi->tujuan_jangka_panjang !!}</p>
                </li>
                <hr>
                <li>
                    <h3><b>Tujuan Jangka pendek (satu tahun)</b></h3>
                    <p>{!! $ppi->tujuan_jangka_pendek !!}</p>
                </li>
            </ul>
            
            @endforeach

            <a href="{{ route('ppiA.pdf', $ppiA->id) }}" class="btn btn-success">Download PDF</a>
            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
@endsection
