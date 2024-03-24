@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Data Donatur</h2>
        <form action="{{ route('dataDonatur.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="donasi_id">Jenis Donasi</label>
                <select class="form-control js-example-basic-single" id="donasi_id" name="donasi_id[]" multiple>
                    @foreach ($donasi as $donasiItem)
                        <option value="{{ $donasiItem->id }}">{{ $donasiItem->jenis_donasi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama_donatur">Nama Donatur:</label>
                <input type="text" class="form-control" id="nama_donatur" name="nama_donatur">
            </div>
            <div class="form-group">
                <label for="email_donatur">Email Donatur:</label>
                <input type="text" class="form-control" id="email_donatur" name="email_donatur">
            </div>
            <div class="form-group">
                <label for="no_hp_donatur">No. Hp Donatur:</label>
                <input type="text" class="form-control" id="no_hp_donatur" name="no_hp_donatur">
            </div>
            <div class="form-group">
                <label for="jumlah_donasi">Jumlah Donasi:</label>
                <input type="text" class="form-control" id="jumlah_donasi" name="jumlah_donasi"> <!-- Changed to number type -->
            </div>
            <div class="form-group">
                <label for="foto_donatur">Foto Donatur:</label>
                <input type="file" class="form-control" name="foto_donatur">
                <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
