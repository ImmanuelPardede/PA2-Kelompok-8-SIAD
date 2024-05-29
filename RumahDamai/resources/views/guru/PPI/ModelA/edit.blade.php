@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit PPI A</h2>
                <form action="{{ route('ppiA.update', ['id' => $ppiA->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Add this line for PUT method -->
                    <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                    @foreach ($detailppi as $key => $ppi)
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="level_komunikasi">Level Komunikasi<span style="color: red">*</span></label>
                                <textarea id="editor1" class="form-control @error('level_komunikasi') is-invalid @enderror" name="level_komunikasi"
                                    required autocomplete="level_komunikasi">{{ $ppi->level_komunikasi }}
                                </textarea>
                                @error('level_komunikasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="gambaran_sensorik" class="form-label">Gambaran sensory & lainnya<span
                                        style="color: red">*</span></label>
                                <textarea id="editor2" class="form-control @error('gambaran_sensorik') is-invalid @enderror" name="gambaran_sensorik"
                                    required autocomplete="gambaran_sensorik">{{ $ppi->gambaran_sensorik }}
                            </textarea>
                                @error('gambaran_sensorik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="informasi_penting" class="form-label">Informasi penting tentang anak<span
                                        style="color: red">*</span></label>
                                <textarea id="editor3" class="form-control @error('informasi_penting') is-invalid @enderror" name="informasi_penting"
                                    required autocomplete="informasi_penting">{{ $ppi->informasi_penting }}
                            </textarea>
                                @error('informasi_penting')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="kondisi_lain" class="form-label">Kondisi lain yang berhubungan dengan anak<span
                                        style="color: red">*</span></label>
                                <textarea id="editor4" class="form-control @error('kondisi_lain') is-invalid @enderror" name="kondisi_lain" required
                                    autocomplete="kondisi_lain">{{ $ppi->kondisi_lain }}
                            </textarea>
                                @error('kondisi_lain')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="layanan_lain" class="form-label">Layanan lain yang sebaiknya diberikan<span
                                        style="color: red">*</span></label>
                                <textarea id="editor5" class="form-control @error('layanan_lain') is-invalid @enderror" name="layanan_lain" required
                                    autocomplete="layanan_lain">{{ $ppi->layanan_lain }}
                            </textarea>
                                @error('layanan_lain')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="tujuan_jangka_panjang" class="form-label">Tujuan Jangka Panjang (mimpi tiga atau
                                    lima tahun
                                    yang akan datang)<span style="color: red">*</span></label>
                                <textarea id="editor6" class="form-control @error('tujuan_jangka_panjang') is-invalid @enderror"
                                    name="tujuan_jangka_panjang" required autocomplete="tujuan_jangka_panjang">{{ $ppi->tujuan_jangka_panjang }}
                            </textarea>
                                @error('tujuan_jangka_panjang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="tujuan_jangka_pendek" class="form-label">Tujuan Jangka pendek (satu tahun)<span
                                        style="color: red">*</span></label>
                                <textarea id="editor7" class="form-control @error('tujuan_jangka_pendek') is-invalid @enderror"
                                    name="tujuan_jangka_pendek" required autocomplete="tujuan_jangka_pendek">{{ $ppi->tujuan_jangka_pendek }}
                            </textarea>
                                @error('tujuan_jangka_pendek')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>

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
        @endsection
