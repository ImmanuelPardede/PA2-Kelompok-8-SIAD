@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $pengumuman->judul }}</div>

                <div class="card-body">
                    <p>{{ $pengumuman->deskripsi }}</p>
                    <p><strong>Kategori:</strong> {{ $pengumuman->kategori }}</p>
                </div>
                <div class="card-footer">
                    <div class="text-muted">Diposting oleh {{ $pengumuman->user->name }} pada {{ $pengumuman->created_at->format('d M Y H:i') }}</div>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
