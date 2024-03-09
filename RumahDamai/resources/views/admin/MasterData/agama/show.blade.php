@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Agama</h2>

        <div>
            <strong>Nama Agama:</strong> {{ $agama->agama }}
        </div>

        <a href="{{ route('agama.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
