@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Riwayat Medis</h2>

        <!-- Tampilkan pesan kesalahan validasi jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('riwayatMedis.update', $riwayatmedis->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="riwayat_perawatan">Riwayat Perawatan:</label>
                <input type="text" class="form-control" name="riwayat_perawatan" value="{{ old('riwayat_perawatan', $riwayatmedis->riwayat_perawatan) }}" required>
            </div>

            <div class="form-group">
                <label for="riwayat_perilaku">Riwayat Perilaku:</label>
                <textarea class="form-control" name="riwayat_perilaku" required>{{ old('riwayat_perilaku', $riwayatmedis->riwayat_perilaku) }}</textarea>
            </div>

            <div class="form-group">
                <label for="deskripsi_riwayat">Deskripsi Riwayat:</label>
                <input type="text" class="form-control" name="deskripsi_riwayat" value="{{ old('deskripsi_riwayat', $riwayatmedis->deskripsi_riwayat) }}" required>
            </div>

            <div class="form-group">
                <label for="kondisi">Kondisi:</label>
                <textarea class="form-control" name="kondisi" required>{{ old('kondisi', $riwayatmedis->kondisi) }}</textarea>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
