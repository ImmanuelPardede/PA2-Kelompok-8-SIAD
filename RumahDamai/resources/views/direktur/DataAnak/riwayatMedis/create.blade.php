@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Riwayat Medis</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('direktur.riwayatMedis.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="anak_id">Nama Anak <span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="anak_id" name="anak_id" required>
                            <option value="" disabled selected>-- Nama Anak --</option>
                            @foreach ($anak as $anakItem)
                                <option value="{{ $anakItem->id }}" {{ old('anak_id') == $anakItem->id ? 'selected' : '' }}>
                                    {{ $anakItem->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="penyakit_id">Jenis Penyakit <span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="penyakit_id" name="penyakit_id" required>
                            <option value="" disabled selected>-- Pilih Jenis Penyakit --</option>
                            @foreach ($penyakit as $penyakitList)
                                <option value="{{ $penyakitList->id }}">{{ $penyakitList->jenis_penyakit }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="riwayat_perawatan" class="form-label">Riwayat Medis<span
                                style="color: red">*</span></label>
                        <textarea id="editor1" class="form-control @error('riwayat_perawatan') is-invalid @enderror" name="riwayat_perawatan"
                            required autocomplete="riwayat_perawatan">
                    <ul>
                    </ul>
                    {{ old('riwayat_perawatan') }}
                </textarea>
                        @error('riwayat_perawatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="riwayat_perilaku" class="form-label">riwayat_perilaku<span
                                style="color: red">*</span></label>
                        <textarea id="editor2" class="form-control @error('riwayat_perilaku') is-invalid @enderror" name="riwayat_perilaku"
                            required autocomplete="riwayat_perilaku">
                    <ul>
                    </ul>
                    {{ old('riwayat_perilaku') }}
                </textarea>
                        @error('riwayat_perilaku')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_riwayat" class="form-label">Deskripsi Riwayat<span
                                style="color: red">*</span></label>
                        <textarea id="editor3" class="form-control @error('deskripsi_riwayat') is-invalid @enderror" name="deskripsi_riwayat"
                            required autocomplete="deskripsi_riwayat">
                    <ul>
                    </ul>
                    {{ old('deskripsi_riwayat') }}
                </textarea>
                        @error('deskripsi_riwayat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi<span style="color: red">*</span></label>
                        <textarea id="editor4" class="form-control @error('kondisi') is-invalid @enderror" name="kondisi" required
                            autocomplete="kondisi">
                    <ul>
                    </ul>
                    {{ old('kondisi') }}
                </textarea>
                        @error('kondisi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Anda perlu menyertakan jQuery -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });

        ClassicEditor
            .create(document.querySelector('#editor2'), {
                // Konfigurasi CKEditor 5 untuk textarea kedua
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });

        ClassicEditor
            .create(document.querySelector('#editor3'), {
                // Konfigurasi CKEditor 5 untuk textarea kedua
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });

        ClassicEditor
            .create(document.querySelector('#editor4'), {
                // Konfigurasi CKEditor 5 untuk textarea kedua
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>
