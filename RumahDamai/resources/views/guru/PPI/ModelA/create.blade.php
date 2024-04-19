@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Create PPI and Detail PPI</h2>
    <form action="{{ route('PPI.ModelA.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="anak_id">Nama Anak <span style="color: red">*</span></label>
            <select class="form-control js-example-basic-single" id="anak_id" name="anak_id" >
                <option value="" disabled selected>-- Pilih Nama Anak --</option>
                @foreach ($anak as $anakItem)
                <option value="{{ $anakItem->id }}">{{ $anakItem->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>


        <div class="mb-3">
            <label for="gambaran_sensory" class="form-label">Gambaran Sensory<span style="color: red">*</span></label>
            <textarea id="editor1" class="form-control @error('gambaran_sensory') is-invalid @enderror" name="gambaran_sensory[]" required autocomplete="gambaran_sensory">
                <ul>
                    <li>..</li>
                </ul>
                {{ old('gambaran_sensory') }}
            </textarea>
            @error('gambaran_sensory')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="data_medis" class="form-label">Data Medis<span style="color: red">*</span></label>
            <textarea id="editor2" class="form-control @error('data_medis') is-invalid @enderror" name="data_medis[]" required autocomplete="data_medis">
                <ul>
                    <li>..</li>
                </ul>
                {{ old('data_medis') }}
            </textarea>
            @error('data_medis')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        
        
        <div class="mb-3">
            <label for="hal_disukai" class="form-label">Soskom<span style="color: red">*</span></label>
            <textarea id="editor3" class="form-control @error('hal_disukai') is-invalid @enderror" name="hal_disukai[]" required autocomplete="hal_disukai">
                <ul>
                    <li>..</li>
                </ul>
                {{ old('hal_disukai') }}
            </textarea>
            @error('hal_disukai')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kondisi_lain" class="form-label">kondisi_lain<span style="color: red">*</span></label>
            <textarea id="editor4" class="form-control @error('kondisi_lain') is-invalid @enderror" name="kondisi_lain[]" required autocomplete="kondisi_lain">
                <ul>
                    <li>..</li>
                </ul>
                {{ old('kondisi_lain') }}
            </textarea>
            @error('kondisi_lain')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


      <div class="form-group row">

<div class="col-md-6">
        <div class="form-group">
            <label for="jangka">Tujuan Jangka:</label>
            <input type="text" class="form-control" id="jangka" name="jangka[]" value="Jangka Panjang" readonly>
        </div>

        <!-- Input untuk Jangka Panjang -->
        <div class="form-group">
            <label for="bina_diri">Bina diri:</label>
            <input type="text" class="form-control" id="bina_diri" name="bina_diri[]" >
            <div class="bina_diri">
            </div>
            <a href="#" class="add-bina_diri btn btn-primary mt-3">Tambah bina_diri</a>
        </div>

        <script>
            $(document).ready(function() {
                // Event listener untuk tombol "Tambah Detail"
                $('.add-bina_diri').on('click', function(event) {
                    event.preventDefault();
                    addbina_diri();
                });

        
                // Fungsi untuk menambahkan detail bina_diri
                function addbina_diri() {
                    var bina_diri = `
                        <hr>
                        <div class="form-group">
                            <label for="bina_diri">bina_diri:</label>
                            <input type="text" class="form-control" name="bina_diri[]" >
                            <a href="#" class="remove-bina_diri btn btn-danger" >Hapus</a>
                        </div>
                    `;
                    $('.bina_diri').append(bina_diri);
                }

        
                // Event listener untuk tombol "Hapus"
                $(document).on('click', '.remove-bina_diri', function(event) {
                event.preventDefault();
                $(this).parent().remove();
            });

            });
        </script>


        <div class="form-group">
            <label for="sosialisasi_dan_komunikasi">Sosialisasi dan Komunikasi</label>
            <input type="text" class="form-control" id="sosialisasi_dan_komunikasi" name="sosialisasi_dan_komunikasi[]" >
        </div>

        <div class="form-group">
            <label for="bekerja">bekerja</label>
            <input type="text" class="form-control" id="bekerja" name="bekerja[]" >
        </div>

        <div class="form-group">
            <label for="akademik">Akademik:</label>
            <input type="text" class="form-control" id="akademik" name="akademik[]" >
        </div>
    </div>
    <div class="col-md-6">

        <!-- Input untuk Jangka Pendek -->
        <div class="form-group">
            <label for="jangka">Tujuan Jangka Pendek:</label>
            <input type="text" class="form-control" id="jangka" name="jangka[]" value="Jangka Pendek" readonly>
        </div>

        <div class="form-group">
            <label for="bina_diri">Bina diri:</label>
            <input type="text" class="form-control" id="bina_diri" name="bina_diri[]" >
        </div>

        <div class="form-group">
            <label for="sosialisasi_dan_komunikasi">Sosialisasi dan Komunikasi</label>
            <input type="text" class="form-control" id="sosialisasi_dan_komunikasi" name="sosialisasi_dan_komunikasi[]" >
        </div>

        <div class="form-group">
            <label for="bekerja">bekerja</label>
            <input type="text" class="form-control" id="bekerja" name="bekerja[]" >
        </div>

        <div class="form-group">
            <label for="akademik">Akademik:</label>
            <input type="text" class="form-control" id="akademik" name="akademik[]" >
        </div>
    </div>
        </div>  






        <!-- Form untuk Tujuan -->
{{--         <div class="form-group">
            <label for="jangka">Jangka</label>
            <input type="text" class="form-control" id="jangka" name="jangka[]" >
            <div class="jangka">
            </div>
            <a href="#" class="add-jangka btn btn-primary mt-3">Tambah jangka</a>
        </div>

        <script>
            $(document).ready(function() {
                // Event listener untuk tombol "Tambah Detail"
                $('.add-jangka').on('click', function(event) {
                    event.preventDefault();
                    addjangka();
                });

        
                // Fungsi untuk menambahkan detail jangka
                function addjangka() {
                    var jangka = `
                        <hr>
                        <div class="form-group">
                            <label for="jangka">jangka:</label>
                            <input type="text" class="form-control" name="jangka[]" >
                            <a href="#" class="remove-jangka btn btn-danger" >Hapus</a>
                        </div>
                    `;
                    $('.jangka').append(jangka);
                }

        
                // Event listener untuk tombol "Hapus"
                $(document).on('click', '.remove-jangka', function(event) {
                event.preventDefault();
                $(this).parent().remove();
            });

            });
        </script>

        <div class="form-group">
    <label for="bina_diri">Bina Diri</label>
    <input type="text" class="form-control" name="bina_diri[]" >
</div>

<div class="form-group">
    <label for="sosialisasi_dan_komunikasi">Sosialisasi dan Komunikasi</label>
    <input type="text" class="form-control" name="sosialisasi_dan_komunikasi[]" >
</div>

<div class="form-group">
    <label for="bekerja">Bekerja</label>
    <input type="text" class="form-control" name="bekerja[]" >
</div>

<div class="form-group">
    <label for="akademik">Akademik</label>
    <input type="text" class="form-control" name="akademik[]" >
</div> --}}
        <hr>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

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
            ClassicEditor
            .create(document.querySelector('#editor5'), {
                // Konfigurasi CKEditor 5 untuk textarea kedua
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>




@endsection


