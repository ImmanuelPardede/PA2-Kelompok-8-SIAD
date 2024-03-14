@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Riwayat Medis</h2>

        <div>
            <strong>Riwayat Perawatan:</strong> {{ $riwayatMedis->riwayat_perawatan }}<br>
            <strong>Riwayat Perilaku:</strong> {{ $riwayatMedis->riwayat_perilaku }}<br>
            <strong>Deskripsi Riwayat:</strong> {{ $riwayatMedis->deskripsi_riwayat }}<br>
            <strong>Kondisi:</strong> {{ $riwayatMedis->kondisi }}
        </div>

        <a href="{{ route('riwayatMedis.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
