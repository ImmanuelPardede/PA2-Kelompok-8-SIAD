@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Kelamin</h2>

        <div>
            <strong>ID:</strong> {{ $kelamin->id }}<br>
            <strong>Nama Kelamin:</strong> {{ $kelamin->jenis_kelamin }}
        </div>

        <a href="{{ route('jenisKelamin.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
