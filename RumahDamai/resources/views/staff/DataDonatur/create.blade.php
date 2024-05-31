@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Data Donatur</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('dataDonatur.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="donasi_id">Jenis Donasi<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="donasi_id" name="donasi_id[]" multiple>
                            @foreach ($donasi as $donasiItem)
                                <option value="{{ $donasiItem->id }}"
                                    {{ collect(old('donasi_id'))->contains($donasiItem->id) ? 'selected' : '' }}>
                                    {{ $donasiItem->jenis_donasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_donatur">Nama Donatur<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="nama_donatur" name="nama_donatur"
                            value="{{ old('nama_donatur') }}">
                    </div>
                    <div class="form-group">
                        <label for="email_donatur">Email Donatur<span style="color: red">*</span></label>
                        <input type="email" class="form-control" id="email_donatur" name="email_donatur"
                            value="{{ old('email_donatur') }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_donatur">Tanggal Donasi<span style="color: red">*</span></label>
                        <input type="date" class="form-control" id="tanggal_donatur" name="tanggal_donatur"
                            value="{{ old('tanggal_donatur') }}">
                    </div>
                    <div class="form-group">
                        <label for="no_hp_donatur">No. Hp Donatur</label>
                        <input type="text" class="form-control" id="no_hp_donatur" name="no_hp_donatur"
                            value="{{ old('no_hp_donatur') }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            value="{{ old('deskripsi') }}">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_donasi">Jumlah Donasi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="height: 100%;">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="jumlah_donasi" name="jumlah_donasi"
                                value="{{ old('jumlah_donasi') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto_donatur">Foto Donatur<span style="color: red">*</span></label>
                        <input type="file" class="form-control" id="foto_donatur" name="foto_donatur">
                        <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
