@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Form Format Laporan</h2>
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

                <form action="{{ route('admin.formatLaporan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kode_laporan">Kode Laporan<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="kode_laporan" name="kode_laporan" required>
                            <option value="" disabled selected>-- Pilih Kode Laporan --</option>
                            @foreach ($kodeLaporan as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }}</option>
                            @endforeach
                        </select>
                        @error('kode_laporan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_laporan">Nama Laporan</label>
                        <input type="text" class="form-control" name="nama_laporan">{{ old('nama_laporan') }}
                    </div>

                    <div class="form-group">
                        <label for="format_laporan">Format Laporan<span style="color: red">*</span></label>
                        <input type="file" class="form-control" name="format_laporan" required>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
