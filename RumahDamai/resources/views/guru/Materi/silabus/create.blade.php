@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Silabus</h2>
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
                <form action="{{ route('silabus.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="tahun_kurikulum_id">Tahun Kurikulum<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="tahun_kurikulum_id"
                            name="tahun_kurikulum_id">
                            <option value="" disabled selected>-- Tahun Kurikulum --</option>
                            @foreach ($tahunKurikulum as $tahunKurikulumItem)
                                <option value="{{ $tahunKurikulumItem->id }}">{{ $tahunKurikulumItem->tahun_kurikulum }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelas_id">Nama Kelas<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="kelas_id" name="kelas_id">
                            <option value="" disabled selected>-- Nama Kelas --</option>
                            @foreach ($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="editor1" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                            autocomplete="deskripsi">
                            <ol><li></li></ol>{{ old('deskripsi') }}
                        </textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hasil_kursus" class="form-label">Hasil Kursus</label>
                        <textarea id="editor2" class="form-control @error('hasil_kursus') is-invalid @enderror" name="hasil_kursus"
                            autocomplete="hasil_kursus">
                            <ol><li></li></ol>{{ old('hasil_kursus') }}
                        </textarea>
                        @error('hasil_kursus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tipe_pembelajaran" class="form-label">Tipe Pembelajaran</label>
                        <textarea id="editor3" class="form-control @error('tipe_pembelajaran') is-invalid @enderror" name="tipe_pembelajaran"
                            autocomplete="tipe_pembelajaran">
                            <ol><li></li></ol>{{ old('tipe_pembelajaran') }}
                        </textarea>
                        @error('tipe_pembelajaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="penilaian" class="form-label">Penilaian</label>
                        <textarea id="editor4" class="form-control @error('penilaian') is-invalid @enderror" name="penilaian"
                            autocomplete="penilaian">
                            <ol><li></li></ol>{{ old('penilaian') }}
                        </textarea>
                        @error('penilaian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="konten_kursus" class="form-label">Konten Kursus
                        </label>
                        <textarea id="editor5" class="form-control @error('konten_kursus') is-invalid @enderror" name="konten_kursus"
                            autocomplete="konten_kursus">
                            <ol><li></li></ol>{{ old('konten_kursus') }}
                        </textarea>
                        @error('konten_kursus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="buku_pegangan_dan_referensi" class="form-label">Buku Pegangan Dan Referensi</label>
                        <textarea id="editor6" class="form-control @error('buku_pegangan_dan_referensi') is-invalid @enderror"
                            name="buku_pegangan_dan_referensi" autocomplete="buku_pegangan_dan_referensi">
                            <ol><li></li></ol>{{ old('buku_pegangan_dan_referensi') }}
                        </textarea>
                        @error('buku_pegangan_dan_referensi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alat" class="form-label">Alat</label>
                        <textarea id="editor7" class="form-control @error('alat') is-invalid @enderror" name="alat" autocomplete="alat">
                            <ol><li></li></ol>{{ old('alat') }}
                        </textarea>
                        @error('alat')
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
