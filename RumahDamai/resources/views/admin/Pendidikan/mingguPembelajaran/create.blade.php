@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Minggu Pembelajaran</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.mingguPembelajaran.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="lokasi_penugasan_id">Lokasi Penugasan<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" name="lokasi_penugasan_id" required>
                            <option value="" disabled selected>-- Pilih Lokasi Penugasan --</option>
                            @foreach ($lokasiPenugasanList as $lokasiPenugasan)
                                <option value="{{ $lokasiPenugasan->id }}">{{ $lokasiPenugasan->lokasi }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="minggu_pembelajaran">Minggu Pembelajaran<span style="color: red">*</span></label>
                        <input type="text" class="form-control js-example-basic-single" name="minggu_pembelajaran"
                            value="{{ old('minggu_pembelajaran') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai<span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_berakhir">Tanggal Berakhir<span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="tanggal_berakhir"
                            value="{{ old('tanggal_berakhir') }}" required>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
