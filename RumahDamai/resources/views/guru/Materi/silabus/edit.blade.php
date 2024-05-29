@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Silabus</h2>
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

                <form action="{{ route('silabus.update', $silabus->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="tahun_kurikulum_id">Tahun Kurikulum</label>
                        <select class="form-control js-example-basic-single" id="tahun_kurikulum_id" name="tahun_kurikulum_id">
                            @foreach ($tahunKurikulum as $tahun)
                                <option value="{{ $tahun->id }}"
                                    {{ $silabus->tahun_kurikulum_id == $tahun->id ? 'selected' : '' }}>
                                    {{ $tahun->tahun_kurikulum }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelas_id">Nama Kelas</label>
                        <select class="form-control js-example-basic-single" id="kelas_id" name="kelas_id">
                            @foreach ($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}"
                                    {{ $silabus->kelas_id == $kelasItem->id ? 'selected' : '' }}>
                                    {{ $kelasItem->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi<span style="color: red">*</span></label>
                        <textarea id="editor1" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required
                            autocomplete="deskripsi">
            {{ $silabus->deskripsi }}
        </textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="hasil_kursus" class="form-label">Hasil Kursus<span style="color: red">*</span></label>
                        <textarea id="editor2" class="form-control @error('hasil_kursus') is-invalid @enderror" name="hasil_kursus" required
                            autocomplete="hasil_kursus">
            {{ $silabus->hasil_kursus }}
        </textarea>
                        @error('hasil_kursus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tipe_pembelajaran" class="form-label">Tipe Pembelajaran<span
                                style="color: red">*</span></label>
                        <textarea id="editor3" class="form-control @error('tipe_pembelajaran') is-invalid @enderror" name="tipe_pembelajaran"
                            required autocomplete="tipe_pembelajaran">
            {{ $silabus->tipe_pembelajaran }}
        </textarea>
                        @error('tipe_pembelajaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penilaian" class="form-label">Penilaian<span style="color: red">*</span></label>
                        <textarea id="editor4" class="form-control @error('penilaian') is-invalid @enderror" name="penilaian" required
                            autocomplete="penilaian">
            {{ $silabus->penilaian }}
        </textarea>
                        @error('penilaian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="konten_kursus" class="form-label">Konten Kursus<span style="color: red">*</span></label>
                        <textarea id="editor5" class="form-control @error('konten_kursus') is-invalid @enderror" name="konten_kursus" required
                            autocomplete="konten_kursus">
            {{ $silabus->konten_kursus }}
        </textarea>
                        @error('konten_kursus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="buku_pegangan_dan_referensi" class="form-label">Buku Pegangan Dan
                            Referensi<span style="color: red">*</span></label>
                        <textarea id="editor6" class="form-control @error('buku_pegangan_dan_referensi') is-invalid @enderror"
                            name="buku_pegangan_dan_referensi" required autocomplete="buku_pegangan_dan_referensi">
            {{ $silabus->buku_pegangan_dan_referensi }}
        </textarea>
                        @error('buku_pegangan_dan_referensi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alat" class="form-label">Alat<span style="color: red">*</span></label>
                        <textarea id="editor7" class="form-control @error('alat') is-invalid @enderror" name="alat" required
                            autocomplete="alat">
            {{ $silabus->alat }}
        </textarea>
                        @error('alat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" id="submitButton" class="btn btn-success mr-2"
                        onclick="handleUpdatedConfirmation(event)">Perbaharui</button>
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
