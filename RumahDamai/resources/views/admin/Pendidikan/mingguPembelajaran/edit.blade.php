@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Minggu Pembelajaran</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('admin.mingguPembelajaran.update', $mingguPembelajaran->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="lokasi_penugasan_id">Lokasi Penugasan<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" name="lokasi_penugasan_id" required>
                            <option value="" disable selected>-- Pilih Lokasi Penugasan --</option>
                            @foreach ($lokasiPenugasanList as $lokasiPenugasan)
                                <option value="{{ $lokasiPenugasan->id }}"
                                    {{ old('lokasi_penugasan_id', $mingguPembelajaran->lokasi_penugasan_id) == $lokasiPenugasan->id ? 'selected' : '' }}>
                                    {{ $lokasiPenugasan->lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="minggu_pembelajaran">Minggu Pembelajaran<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="minggu_pembelajaran"
                            value="{{ old('minggu_pembelajaran', $mingguPembelajaran->minggu_pembelajaran) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai<span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="tanggal_mulai"
                            value="{{ old('tanggal_mulai', $mingguPembelajaran->tanggal_mulai) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_berakhir">Tanggal Berakhir<span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="tanggal_berakhir"
                            value="{{ old('tanggal_berakhir', $mingguPembelajaran->tanggal_berakhir) }}" required>
                    </div>

                    <a href="{{ route('admin.mingguPembelajaran.index') }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
