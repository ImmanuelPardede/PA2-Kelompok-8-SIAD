@extends('layouts.management.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Tambah Latar Belakang Anak</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    Terdapat kesalahan saat validasi data. Mohon periksa kembali.
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.latarBelakang.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="anak_id">Nama Anak <span style="color: red">*</span></label>
                    <select class="form-control js-example-basic-single" id="anak_id" name="anak_id" required>
                        <option value="" disabled selected>-- Pilih Anak --</option>
                        @foreach ($anak as $anakItem)
                            <option value="{{ $anakItem->id }}" {{ old('anak_id') == $anakItem->id ? 'selected' : '' }}>
                                {{ $anakItem->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="usia">Usia <span style="color: red">*</span></label>
                    <input type="number" class="form-control" name="usia" value="{{ old('usia') }}" required>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="kelas" value="{{ old('kelas') }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal <span style="color: red">*</span></label>
                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}" required>
                </div>

                <div id="gambar_latar_belakang_wrapper">
                    <div class="form-group" id="gambar_latar_belakang_group_1">
                        <label for="gambar_latar_belakang_1">Gambar Latar Belakang</label>
                        <div class="d-flex align-items-center mb-2">
                            <input type="file" class="form-control" id="gambar_latar_belakang_1" name="gambar_latar_belakang[]" accept="image/*" required>
                            <button type="button" class="btn btn-danger ml-2" onclick="hapusGambarDanDeskripsi(1)">Hapus</button>
                        </div>
                        <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                    </div>
                    <div class="form-group mb-3" id="deskripsi_group_1">
                        <label for="deskripsi_1" class="form-label">Deskripsi<span style="color: red">*</span></label>
                        <textarea id="deskripsi_1" class="form-control" name="deskripsi[]" required autocomplete="deskripsi">
                            {{ old('deskripsi') }}
                            <ul>
                                <li></li>
                            </ul>
                        </textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="button" class="btn btn-primary" onclick="tambahGambarDanDeskripsi()">Tambah Gambar & Deskripsi</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script>
    let counter = 1;

    function tambahGambarDanDeskripsi() {
        counter++;
        let newGambarLatarBelakang = `
        <div class="form-group" id="gambar_latar_belakang_group_${counter}">
                <label for="gambar_latar_belakang_${counter}">Gambar Latar Belakang</label>
                <div class="d-flex align-items-center mb-2">
                    <input type="file" class="form-control" id="gambar_latar_belakang_${counter}" name="gambar_latar_belakang[]" accept="image/*" required>
                    <button type="button" class="btn btn-danger ml-2" onclick="hapusGambarDanDeskripsi(${counter})">Hapus</button>
                </div>
                <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
            </div>
        `;
        let newDeskripsi = `
        <div class="form-group mb-3" id="deskripsi_group_${counter}">
                <label for="deskripsi_${counter}" class="form-label">Deskripsi<span style="color: red">*</span></label>
                <textarea id="deskripsi_${counter}" class="form-control" name="deskripsi[]" required autocomplete="deskripsi"></textarea>
                <span class="invalid-feedback" role="alert" id="deskripsi-error-${counter}" style="display: none;">
                    <strong></strong>
                </span>
            </div>
        `;
        document.getElementById('gambar_latar_belakang_wrapper').insertAdjacentHTML('beforeend', newGambarLatarBelakang);
        document.getElementById('gambar_latar_belakang_wrapper').insertAdjacentHTML('beforeend', newDeskripsi);
    }

    function hapusGambarDanDeskripsi(index, imageId = null) {
        if (index > 0) {
            document.getElementById(`gambar_latar_belakang_group_${index}`).remove();
            document.getElementById(`deskripsi_group_${index}`).remove();
            if (imageId) {
                document.getElementById('gambar_latar_belakang_wrapper').insertAdjacentHTML('beforeend', `<input type="hidden" name="deleted_images[]" value="${imageId}">`);
            }
        } else {
            alert('Tidak dapat menghapus elemen pertama.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor for existing textareas
        document.querySelectorAll('textarea[name="deskripsi[]"]').forEach(textarea => {
            ClassicEditor.create(textarea).catch(error => {
                console.error('Error initializing CKEditor:', error);
            });
        });
    });
</script>
