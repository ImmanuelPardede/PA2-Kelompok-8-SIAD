@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Lokasi Penugasan</h2>

        <div>
            <strong>ID:</strong> {{ $lokasi->lokasi_penugasan_id }}<br>
            <strong>Nama Wilayah:</strong> {{ $lokasi->wilayah }}<br>
            <strong>Lokasi:</strong> {{ $lokasi->lokasi }}<br>
            <strong>Deskripsi:</strong> {{ $lokasi->deskripsi }}
        </div>

        <a href="{{ route('lokasiTugas.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
