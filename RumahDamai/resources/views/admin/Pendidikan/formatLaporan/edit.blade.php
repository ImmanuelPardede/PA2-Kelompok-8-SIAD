@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Format Laporan</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.formatLaporan.update', $formatLaporan->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kode_laporan">Kode Laporan:</label>
                        <select class="form-control js-example-basic-single" id="kode_laporan" name="kode_laporan">
                            <option value="" disabled>-- Pilih Kode Laporan --</option>
                            @foreach ($kodeLaporan as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $formatLaporan->kode_laporan_id ? 'selected' : '' }}>
                                    {{ $item->kode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_laporan">Nama Laporan:</label>
                        <input type="text" class="form-control" name="nama_laporan" value="{{ old('nama_laporan', $formatLaporan->nama_laporan) }}">
                    </div>

                    <div class="form-group">
                        <label for="format_laporan">Format Laporan:</label>
                        <input type="file" class="form-control" name="format_laporan">
                        @error('format_laporan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
