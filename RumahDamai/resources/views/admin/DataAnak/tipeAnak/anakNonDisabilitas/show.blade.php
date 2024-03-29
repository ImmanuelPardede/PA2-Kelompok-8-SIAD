@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Jenis Anak Non Disabilitas</h2>

        <div>
            <strong>Kategori Anak Non Disabilitas:</strong> {{ $anakNonDisabilitas->kategori_anak_non_disabilitas }}<br>
            <strong>Jenis Anak Disabilitas:</strong> {{ $anakNonDisabilitas->jenis_anak_non_disabilitas }}<br>
            <strong>Deskripsi:</strong> {{ $anakNonDisabilitas->deskripsi ?? 'Data tidak tersedia'}}
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
