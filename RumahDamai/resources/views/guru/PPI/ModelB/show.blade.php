@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail PPI Model B</h4>
                <div class="form-group">
                    <label for="anak">Nama Anak:</label>
                    <p>{{ $ppiB->anak->nama_lengkap }}</p>
                </div>
                <div class="form-group">
                    <label for="file_ppi_b">File PPI B:</label>
                    @if ($ppiB->file_ppi_b)
                        <a href="{{ route('ppiB.downloadPpiB', $ppiB->id) }}">{{ $ppiB->file_ppi_b }}</a>
                    @else
                        Data tidak tersedia
                    @endif
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <p>{!! nl2br(e($ppiB->deskripsi)) !!}</p>
                </div>
                <a href="{{ route('ppiB.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
