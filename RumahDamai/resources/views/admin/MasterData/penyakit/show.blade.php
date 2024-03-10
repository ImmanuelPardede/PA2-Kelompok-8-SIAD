@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Jenis Penyakit</h2>

        <div>
            <strong>Jenis Penyakit:</strong> {{ $penyakit->jenis_penyakit }}<br>
            <strong>Deskripsi:</strong> {{ $penyakit->deskripsi }}
        </div>

        <a href="{{ route('penyakit.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
