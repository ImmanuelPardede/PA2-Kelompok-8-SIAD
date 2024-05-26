@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah PPI B</h2>
                <form action="{{ route('ppiB.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="anak_id">Anak</label>
                        <select name="anak_id" id="anak_id" class="form-control">
                            <option value="" disabled selected>-- Pilih Anak --</option>
                            @foreach($anakList as $anak)
                                <option value="{{ $anak->id }}">{{ $anak->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="format_laporan_container" class="form-group">
                        @foreach($formatLaporanList as $formatLaporan)
                            @if($formatLaporan->kodeLaporan->kode === 'PPIB')
                                <div>
                                    <p>Format Laporan: {{ $formatLaporan->nama_laporan }}</p>
                                    <p>File: <a href="{{ route('downloadFormatLaporan', $formatLaporan->id) }}" target="_blank">{{ $formatLaporan->format_laporan }}</a></p>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="file_ppi_b">File PPI B</label>
                        <input type="file" name="file_ppi_b" id="file_ppi_b" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
