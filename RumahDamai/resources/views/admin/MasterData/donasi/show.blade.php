@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Jenis Donasi</h2>

        <div>
            <strong>Jenis Donasi:</strong> {{ $donasi->jenis_donasi }}<br>
            <strong>Deskripsi:</strong> {{ $donasi->deskripsi ?? 'Data tidak tersedia'}}
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
