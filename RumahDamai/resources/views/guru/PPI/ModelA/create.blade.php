@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Form PPI Model A</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('ppiA.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="anak_id" value="{{ $anak_id }}">

                    <div class="form-group">
                        <label for="level_komunikasi" class="form-label">Level Komunikasi<span
                                style="color: red">*</span></label>
                        <textarea id="editor1" class="form-control @error('level_komunikasi') is-invalid @enderror" name="level_komunikasi"
                            required autocomplete="level_komunikasi">
                <p>Ekspresif&nbsp;:</p><ol><li></li></ol><p>Reseptif&nbsp;:</p><ol><li></li></ol>
                {{ old('level_komunikasi') }}
            </textarea>
                        @error('level_komunikasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                    <div class="form-group">
                        <label for="gambaran_sensorik" class="form-label">Gambaran sensory & lainnya<span
                                style="color: red">*</span></label>
                        <textarea id="editor2" class="form-control @error('gambaran_sensorik') is-invalid @enderror" name="gambaran_sensorik"
                            required autocomplete="gambaran_sensorik">
                <ol>
                    <li></li>
                </ol>
                {{ old('gambaran_sensorik') }}
            </textarea>
                        @error('gambaran_sensorik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                    <div class="form-group">
                        <label for="informasi_penting" class="form-label">Informasi penting tentang anak<span
                                style="color: red">*</span></label>
                        <textarea id="editor3" class="form-control @error('informasi_penting') is-invalid @enderror" name="informasi_penting"
                            required autocomplete="informasi_penting">
                <p>Data&nbsp;Medis :</p><ol><li></li></ol><p>Hal&nbsp;Yang Disukai :</p><ol><li></li></ol>
                {{ old('informasi_penting') }}
            </textarea>
                        @error('informasi_penting')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                    <div class="form-group">
                        <label for="kondisi_lain" class="form-label">Kondisi lain yang berhubungan dengan anak<span
                                style="color: red">*</span></label>
                        <textarea id="editor4" class="form-control @error('kondisi_lain') is-invalid @enderror" name="kondisi_lain" required
                            autocomplete="kondisi_lain">
                <ol>
                    <li></li>
                </ol>
                {{ old('kondisi_lain') }}
            </textarea>
                        @error('kondisi_lain')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                    <div class="form-group">
                        <label for="layanan_lain" class="form-label">Layanan lain yang sebaiknya diberikan<span
                                style="color: red">*</span></label>
                        <textarea id="editor5" class="form-control @error('layanan_lain') is-invalid @enderror" name="layanan_lain" required
                            autocomplete="layanan_lain">
                <ol>
                    <li></li>
                </ol>
                {{ old('layanan_lain') }}
            </textarea>
                        @error('layanan_lain')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                    <div class="form-group">
                        <label for="tujuan_jangka_panjang" class="form-label">Tujuan Jangka Panjang (mimpi tiga atau lima
                            tahun yang akan datang)<span style="color: red">*</span></label>
                        <textarea id="editor6" class="form-control @error('tujuan_jangka_panjang') is-invalid @enderror"
                            name="tujuan_jangka_panjang" required autocomplete="tujuan_jangka_panjang">
                <p>A. Bina Diri &nbsp;:</p><ol><li></li></ol><p>B. Sosialisasi dan Komunikasi &nbsp;:</p><ol><li></li></ol><p>C. Bekerja&nbsp; :</p><ol><li></li></ol><p>D. Akademik :</p><ol><li></li></ol>
                {{ old('tujuan_jangka_panjang') }}
            </textarea>
                        @error('tujuan_jangka_panjang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                    <div class="form-group">
                        <label for="tujuan_jangka_pendek" class="form-label">Tujuan Jangka pendek (satu tahun)<span
                                style="color: red">*</span></label>
                        <textarea id="editor7" class="form-control @error('tujuan_jangka_pendek') is-invalid @enderror"
                            name="tujuan_jangka_pendek" required autocomplete="tujuan_jangka_pendek">
                <p>A. Bina Diri &nbsp;:</p><ol><li></li></ol><p>B. Sosialisasi dan Komunikasi &nbsp;:</p><ol><li></li></ol><p>C. Bekerja&nbsp; :</p><ol><li></li></ol><p>D. Akademik :</p><ol><li></li></ol>
                {{ old('tujuan_jangka_pendek') }}
            </textarea>
                        @error('tujuan_jangka_pendek')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
            </form>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor2'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor3'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor4'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor5'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor6'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor7'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor7'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>
