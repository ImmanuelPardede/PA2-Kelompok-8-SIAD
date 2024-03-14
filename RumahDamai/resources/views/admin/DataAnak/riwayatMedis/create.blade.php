@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Riwayat Medis</h2>

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

        <form action="{{ route('riwayatMedis.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="riwayat_perawatan">Riwayat Medis:</label>
                <input type="text" class="form-control" name="riwayat_perawatan" value="{{ old('riwayat_perawatan') }}" required>
            </div>

            <div class="form-group">
                <label for="riwayat_perilaku">Riwayat Perilaku:</label>
                <textarea class="form-control" name="riwayat_perilaku" required>{{ old('riwayat_perilaku') }}</textarea>
            </div>

            <div class="form-group">
                <label for="deskripsi_riwayat">Deskripsi Riwayat:</label>
                <input type="text" class="form-control" name="deskripsi_riwayat" value="{{ old('deskripsi_riwayat') }}" required>
            </div>

            <div class="form-group">
                <label for="kondisi">Kondisi:</label>
                <textarea class="form-control" name="kondisi" required>{{ old('kondisi') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
