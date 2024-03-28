@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Data Donatur</h2>

            <p><strong>Foto Donatur:</strong></p>
            @if ($donatur->foto_donatur)
                <img src="{{ asset($donatur->foto_donatur) }}" alt="Foto Donatur" class="img-fluid">
                <strong>Foto Donasi:</strong> {{ $donatur->foto_donatur }}
            @else
                <p>Tidak ada foto Donatur.</p>
            @endif

            <form action="{{ route('dataDonatur.update', $donatur->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="foto_donatur">Foto Donasi Baru:</label>
                    <input type="file" class="form-control" id="foto_donatur" name="foto_donatur">
                </div>

                <div class="form-group">
                    <label for="donasi_id">Jenis Donasi:</label>
                    <select class="form-control" id="donasi_id" name="donasi_id" required>
                        <option value="" disabled>-- Jenis Donasi --</option>
                        @foreach ($donasi as $donasidata)
                            <option value="{{ $donasidata->id }}" {{ $donatur->donasi_id == $donasidata->id ? 'selected' : '' }}>
                                {{ $donasidata->jenis_donasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama_donatur">Nama Donatur:</label>
                    <input type="text" class="form-control" id="nama_donatur" name="nama_donatur"
                        value="{{ $donatur->nama_donatur }}" required>
                </div>

                <div class="form-group">
                    <label for="email_donatur">Email Donatur:</label>
                    <input type="text" class="form-control" id="email_donatur" name="email_donatur"
                        value="{{ $donatur->email_donatur }}" required>
                </div>

                <div class="form-group">
                    <label for="no_hp_donatur">No. Hp Donatur:</label>
                    <input type="text" class="form-control" id="no_hp_donatur" name="no_hp_donatur"
                        value="{{ $donatur->no_hp_donatur }}">
                </div>

                <div class="form-group">
                    <label for="jumlah_donasi">Jumlah Donasi:</label>
                    <input type="text" class="form-control" id="jumlah_donasi" name="jumlah_donasi"
                        value="{{ $donatur->jumlah_donasi }}">
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
