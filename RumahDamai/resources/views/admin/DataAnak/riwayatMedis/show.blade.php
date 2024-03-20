@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Riwayat Medis</h2>

        <div>
            <strong>Riwayat Perawatan:</strong> {{ $riwayatmedis->riwayat_perawatan }}<br>
            <strong>Riwayat Perilaku:</strong> {{ $riwayatmedis->riwayat_perilaku }}<br>
            <strong>Deskripsi Riwayat:</strong> {{ $riwayatmedis->deskripsi_riwayat }}<br>
            <strong>Kondisi:</strong> {{ $riwayatmedis->kondisi }}
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
     </div>
@endsection
