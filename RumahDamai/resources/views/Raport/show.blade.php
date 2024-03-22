@extends('layouts.master')

@section('content')
<a href="{{ route('raport.pdf', $raport->id) }}" class="btn btn-primary" target="_blank">CETAK PDF</a>
    <div class="container">
        <h2>Raport Detail</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="periode_bulan">Periode Bulan:</label>
                    <input type="text" class="form-control" id="periode_bulan" name="periode_bulan" value="{{ $raport->periode_bulan }}" readonly>
                </div>
                <div class="form-group">
                    <label for="area">Area:</label>
                    <input type="text" class="form-control" id="area" name="area" value="{{ $raport->area }}" readonly>
                </div>
                <div class="form-group">
                    <label for="anak_id">Anak:</label>
                    <input type="text" class="form-control" id="anak_id" name="anak_id" value="{{ $raport->anak->nama_lengkap }}" readonly>
                </div>
                <div class="form-group">
                    <label for="kemampuan">Kemampuan:</label>
                    <input type="text" class="form-control" id="kemampuan" name="kemampuan" value="{{ $raport->kemampuan }}" readonly>
                </div>
                <div class="form-group">
                    <label for="kelas_kemampuan">Kelas Kemampuan:</label>
                    <input type="text" class="form-control" id="kelas_kemampuan" name="kelas_kemampuan" value="{{ $raport->kelas_kemampuan }}" readonly>
                </div>
                <div class="form-group">
                    <label for="naratif">Naratif:</label>
                    <textarea class="form-control" id="naratif" name="naratif" readonly>{{ $raport->naratif }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
