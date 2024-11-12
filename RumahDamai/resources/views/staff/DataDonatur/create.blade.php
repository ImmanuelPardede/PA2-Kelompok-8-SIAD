@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Data Donatur</h2>
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
                <form action="{{ route('dataDonatur.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="donasi_id">Jenis Donasi<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-multiple" id="donasi_id" name="donasi_id[]" multiple>
                            @foreach ($donasi as $donasiItem)
                                <option value="{{ $donasiItem->id }}"
                                    {{ collect(old('donasi_id'))->contains($donasiItem->id) ? 'selected' : '' }}>
                                    {{ $donasiItem->jenis_donasi }}
                                </option>
                            @endforeach
                            <option value="lainnya" {{ collect(old('donasi_id'))->contains('lainnya') ? 'selected' : '' }}>
                                Pilihan Lainnya</option>
                        </select>

                        <div class="form-group" id="lainnya_div"
                            style="{{ collect(old('donasi_id'))->contains('lainnya') ? '' : 'display:none;' }}">
                            <label for="lainnya">Jenis Donasi Lainnya</label>
                            <input type="text" class="form-control" id="lainnya" name="lainnya"
                                value="{{ old('lainnya') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_donatur">Nama Donatur<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="nama_donatur" name="nama_donatur"
                            value="{{ old('nama_donatur') }}">
                    </div>
                    <div class="form-group">
                        <label for="email_donatur">Email Donatur<span style="color: red">*</span></label>
                        <input type="email" class="form-control" id="email_donatur" name="email_donatur"
                            value="{{ old('email_donatur') }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_donatur">Tanggal Donasi<span style="color: red">*</span></label>
                        <input type="date" class="form-control" id="tanggal_donatur" name="tanggal_donatur"
                            value="{{ old('tanggal_donatur') }}">
                    </div>
                    <div class="form-group">
                        <label for="no_hp_donatur">No. Hp Donatur</label>
                        <input type="text" class="form-control" id="no_hp_donatur" name="no_hp_donatur"
                            value="{{ old('no_hp_donatur') }}">
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
                        <label for="jumlah_donasi">Jumlah Total</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="height: 100%;">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="jumlah_donasi" name="jumlah_donasi"
                                value="{{ old('jumlah_donasi') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Terbilang</label>
                        <input type="text" class="form-control" id="terbilang" name="terbilang" readonly>
                    </div>

                    <div class="form-group">
                        <label for="foto_donatur">Foto Donatur<span style="color: red">*</span></label>
                        <input type="file" class="form-control" id="foto_donatur" name="foto_donatur">
                        <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        $(document).ready(function() {
            function convertToWords(number) {
                const words = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan"];
                const levels = ["", "ribu", "juta", "miliar", "triliun"];
                if (number == 0) return "nol";

                let result = "";
                let level = 0;

                while (number > 0) {
                    let group = number % 1000;
                    let groupWords = "";

                    if (group >= 100) {
                        groupWords += words[Math.floor(group / 100)] + " ratus ";
                        group %= 100;
                    }
                    if (group >= 10) {
                        if (group >= 20) {
                            groupWords += words[Math.floor(group / 10)] + " puluh ";
                            group %= 10;
                        } else if (group >= 11) {
                            groupWords += "sebelas";
                            group = 0;
                        } else {
                            groupWords += "sepuluh";
                            group = 0;
                        }
                    }
                    if (group > 0) {
                        groupWords += words[group] + " ";
                    }

                    if (groupWords.trim()) {
                        result = groupWords.trim() + " " + levels[level] + " " + result;
                    }

                    level++;
                    number = Math.floor(number / 1000);
                }
                return result.trim();
            }

            $('#jumlah_donasi').on('blur', function() {
                const amount = $(this).val();
                const words = convertToWords(parseInt(amount, 10));
                $('#terbilang').val(words);
            });

            $('#donasi_id').change(function() {
                if ($(this).val().indexOf('lainnya') !== -1) {
                    $('#lainnya_div').show();
                } else {
                    $('#lainnya_div').hide();
                }
            }).trigger('change');
        });
    </script>
@endsection
