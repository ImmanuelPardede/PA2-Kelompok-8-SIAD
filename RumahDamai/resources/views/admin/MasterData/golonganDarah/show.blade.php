@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Golongan Darah</h2>

        <div>
            <strong>Nama Darah:</strong> {{ $darah->golongan_darah }}
        </div>

        <a href="{{ route('golonganDarah.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
