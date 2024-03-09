@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Jenis Kebutuhan</h2>

        <div>
            <strong>Jenis Kebutuhan:</strong> {{ $kebutuhan->jenis_kebutuhan }}<br>
            <strong>Deskripsi:</strong> {{ $kebutuhan->deskripsi }}
        </div>

        <a href="{{ route('kebutuhan.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
