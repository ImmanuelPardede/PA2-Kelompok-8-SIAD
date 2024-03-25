@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Jenis Kebutuhan Disabilitas</h2>

        <div>
            <strong>Jenis Kebutuhan:</strong> {{ $kebutuhan->jenis_kebutuhan }}<br>
            <strong>Deskripsi:</strong> {{ $kebutuhan->deskripsi ?? 'Data tidak tersedia'}}
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
