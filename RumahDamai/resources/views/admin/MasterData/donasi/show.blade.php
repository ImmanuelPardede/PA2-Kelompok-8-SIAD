@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Jenis Donasi</h2>

        <div>
            <strong>Jenis Donasi:</strong> {{ $donasi->jenis_donasi }}<br>
            <strong>Deskripsi:</strong> {{ $donasi->deskripsi }}
        </div>

        <a href="{{ route('donasi.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
