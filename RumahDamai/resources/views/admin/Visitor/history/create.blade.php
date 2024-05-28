@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title text-left">Form Menambah Sejarah Singkat Yayasan</h1>

            <!-- Form untuk menambahkan foundation history -->
            <form method="POST" action="{{ route('admin.history.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar<span style="color: red">*</span></label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                    <small class="text-muted" id="wordCountInfo">Gambar Tidak Boleh Lebih Dari 1.</small>
                </div>

                <!-- Input untuk sejarah singkat -->
                <div class="mb-3">
                    <label for="sejarah_singkat" class="form-label">Sejarah Singkat Yayasan<span style="color: red">*</span></label>
                    <textarea class="form-control" id="sejarah_singkat" name="sejarah_singkat" rows="5" placeholder="Enter brief history" maxlength="255" required></textarea>
                </div>

                <!-- Input untuk tujuan utama -->
                <div class="mb-3">
                    <label for="tujuan_utama" class="form-label">Tujuan Utama Yayasan<span style="color: red">*</span></label>
                    <textarea class="form-control" id="tujuan_utama" name="tujuan_utama" rows="5" placeholder="Enter main purpose" maxlength="255" required></textarea>
                </div>

                <!-- Input untuk tanggal pendirian -->
                <div class="mb-3">
                    <label for="dibangun" class="form-label">Dibangun<span style="color: red">*</span></label>
                    <input type="date" class="form-control" id="dibangun" name="dibangun" required>
                </div>

                <!-- Tombol untuk submit form -->
                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
