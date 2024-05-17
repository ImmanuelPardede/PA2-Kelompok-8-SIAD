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

                <form action="{{ route('latarBelakang.store') }}" method="post" enctype="multipart/form-data">
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

                    <!-- Upload Gambar Latar Belakang -->
                    <div id="gambar_latar_belakang_wrapper">
                        <div class="form-group">
                            <label for="gambar_latar_belakang">Gambar Latar Belakang</label>
                            <input type="file" class="form-control" name="gambar_latar_belakang[]" accept="image/*" required>
                            <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                        </div>
                    </div>

                    <div id="deskripsi_wrapper">
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi<span style="color: red">*</span></label>
                            <textarea id="editor1" class="form-control @error('deskripsi.0') is-invalid @enderror" name="deskripsi[]" required autocomplete="deskripsi">{{ old('deskripsi.0') }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="tambahGambarDanDeskripsi()">Tambah Gambar & Deskripsi</button>
                    <button type="button" class="btn btn-danger" onclick="hapusGambarDanDeskripsi()">Hapus Gambar & Deskripsi</button>


                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>

            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let counter = 1;

    function tambahGambarDanDeskripsi() {
        counter++;
        let newGambarLatarBelakang = `
            <div class="form-group">
                <label for="gambar_latar_belakang">Gambar Latar Belakang</label>
                <input type="file" class="form-control" name="gambar_latar_belakang[]" accept="image/*" required>
                <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
            </div>
        `;
        let newDeskripsi = `
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi<span style="color: red">*</span></label>
                <textarea id="editor${counter}" class="form-control" name="deskripsi[]" required autocomplete="deskripsi"></textarea>
                <span class="invalid-feedback" role="alert" id="deskripsi-error-${counter}" style="display: none;">
                    <strong></strong>
                </span>
            </div>
        `;
        document.getElementById('gambar_latar_belakang_wrapper').insertAdjacentHTML('beforeend', newGambarLatarBelakang);
        document.getElementById('deskripsi_wrapper').insertAdjacentHTML('beforeend', newDeskripsi);

        // Inisialisasi CKEditor baru untuk textarea yang baru ditambahkan
        ClassicEditor
            .create(document.querySelector(`#editor${counter}`), {
                // Konfigurasi CKEditor 5 untuk textarea baru
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    }

    function hapusGambarDanDeskripsi() {
        let gambarLatarBelakangElements = document.getElementsByName('gambar_latar_belakang[]');
        let deskripsiElements = document.getElementsByName('deskripsi[]');

        if (gambarLatarBelakangElements.length > 1 && deskripsiElements.length > 1) {
            gambarLatarBelakangElements[gambarLatarBelakangElements.length - 1].parentNode.remove();
            deskripsiElements[deskripsiElements.length - 1].parentNode.remove();
            counter--;
        } else {
            alert('Tidak dapat menghapus elemen terakhir.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi CKEditor untuk textarea pertama
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>

