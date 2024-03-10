@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Jenis Sponsorship</h2>

        <div>
            <strong>Jenis Sponsorship:</strong> {{ $sponsorship->jenis_sponsorship }}<br>
            <strong>Deskripsi:</strong> {{ $sponsorship->deskripsi }}
        </div>

        <a href="{{ route('sponsorship.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
