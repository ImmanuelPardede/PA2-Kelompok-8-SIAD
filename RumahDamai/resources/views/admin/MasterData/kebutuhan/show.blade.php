@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Kelamin</h2>

        <div>
            <strong>ID:</strong> {{ $kebutuhan->id }}<br>
            <strong>Nama Kelamin:</strong> {{ $kebutuhan->jenis_kebutuhan }}
        </div>

        <a href="{{ route('kebutuhan.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
