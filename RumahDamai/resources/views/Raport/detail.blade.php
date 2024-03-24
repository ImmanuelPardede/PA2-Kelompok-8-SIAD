@extends('layouts.master')

@section('content')
    <h1>Raport Detail</h1>
    <p>Nama Anak: {{ $raport->anak->nama_lengkap }}</p>
    <p>Periode Bulan: {{ $raport->periode_bulan }}</p>
    
    <h2>Detail Raports:</h2>
    @foreach ($detailraports as $detailraport)
        <p>Area: {{ $detailraport->area }}</p>
        <p>Kemampuan: {{ $detailraport->kemampuan }}</p>
        <p>Kelas Kemampuan: {{ $detailraport->kelas_kemampuan }}</p>
        <p>Naratif: {{ $detailraport->naratif }}</p>
        <hr>
    @endforeach
    <a href="{{ route('raport.pdf', $raport->id) }}" class="btn btn-success">Download PDF</a>

    <a href="{{ route('raport.index') }}" class="btn btn-primary">Back</a>
@endsection
