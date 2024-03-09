@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Tingkat Pendidikan</h2>

        <div>
            <strong>Tingkat Pendidikan:</strong> {{ $pendidikan->tingkat_pendidikan }}
        </div>

        <a href="{{ route('pendidikan.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
