@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Jenis Pekerjaan</h2>

        <div>
            <strong>Jenis Pekerjaan:</strong> {{ $pekerjaan->jenis_pekerjaan }}<br>
        </div>

        <a href="{{ route('pekerjaan.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
