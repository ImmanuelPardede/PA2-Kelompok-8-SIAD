@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-left">Form Menambah Galeri</h1>

                <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="img_galeri" class="form-label">Gambar<span style="color: red">*</span></label>
                        <input type="file" class="form-control" id="img_galeri" name="img_galeri[]" accept="image/*"
                            multiple required>
                            <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>

                        <small class="text-muted" id="wordCountInfo">Maksimal 10 Gambar.</small>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label">Kegitan<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Enter judul">
                    </div>

                    <div class="mb-3">
                        <label for="waktu" class="form-label">Waktu<span style="color: red">*</span></label>
                        <input type="date" class="form-control" id="waktu" name="waktu" placeholder="Enter waktu">
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi Kegiatan<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Enter lokasi">
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('img_galeri').addEventListener('change', function() {
            var files = this.files;
            if (files.length > 15) {
                alert('You can only upload a maximum of 15 images.');
                this.value = ''; // Reset the input field
            }
        });
    </script>
@endsection
