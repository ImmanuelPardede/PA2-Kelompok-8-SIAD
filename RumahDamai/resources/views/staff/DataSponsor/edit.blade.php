@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Edit Data Sponsor</h1>

                @if ($sponsor->foto_sponsor)
                    <img src="{{ asset($sponsor->foto_sponsor) }}" alt="Foto Sponsor" class="img-fluid"
                        style="width: 400px; height: auto; display: block; margin: auto;">
                @else
                    <p>Tidak ada foto Sponsor.</p>
                @endif

                <form action="{{ route('dataSponsor.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="foto_sponsor">Foto Sponsor Baru</label>
                        <input type="file" class="form-control" id="foto_sponsor" name="foto_sponsor">
                        <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                    </div>

                    <div class="form-group">
                        <label for="sponsorship_id">Jenis Sponsorship</label>
                        <select class="form-control js-example-basic-single" id="sponsorship_id" name="sponsorship_id[]"
                            multiple>
                            @foreach ($sponsorship as $sponsorshipItem)
                                <option value="{{ $sponsorshipItem->id }}"
                                    {{ in_array($sponsorshipItem->id, old('sponsorship_id', $selectedSponsorshipIds)) ? 'selected' : '' }}>
                                    {{ $sponsorshipItem->jenis_sponsorship }}
                                </option>
                            @endforeach
                            <option value="lainnya"
                                {{ in_array('lainnya', old('sponsorship_id', $selectedSponsorshipIds)) ? 'selected' : '' }}>
                                Pilihan Lainnya
                            </option>
                        </select>
                    </div>

                    <div class="form-group" id="lainnya_div"
                        style="{{ in_array('lainnya', old('sponsorship_id', $selectedSponsorshipIds)) ? '' : 'display:none;' }}">
                        <label for="lainnya">Jenis Sponsorship Lainnya</label>
                        <input type="text" class="form-control" id="lainnya" name="lainnya"
                            value="{{ old('lainnya', $sponsor->lainnya ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label for="nama_sponsor">Nama Sponsor</label>
                        <input type="text" class="form-control" id="nama_sponsor" name="nama_sponsor"
                            value="{{ $sponsor->nama_sponsor }}">
                    </div>

                    <div class="form-group">
                        <label for="email_sponsor">Email Sponsor</label>
                        <input type="email" class="form-control" id="email_sponsor" name="email_sponsor"
                            value="{{ $sponsor->email_sponsor }}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_sponsor">Tanggal Sponsor</label>
                        <input type="date" class="form-control" id="tanggal_sponsor" name="tanggal_sponsor"
                            value="{{ $sponsor->tanggal_sponsor }}">
                    </div>

                    <div class="form-group">
                        <label for="no_telepon_sponsor">No. Hp Sponsor</label>
                        <input type="text" class="form-control" id="no_telepon_sponsor" name="no_telepon_sponsor"
                            value="{{ $sponsor->no_telepon_sponsor }}">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="editor1" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required
                            autocomplete="deskripsi">
            {{ $sponsor->deskripsi }}
        </textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_sponsor">Jumlah Sponsor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="height: 100%;">Rp</span>
                            </div>
                            <input type="text" class="form-control" id="jumlah_sponsor" name="jumlah_sponsor"
                                value="{{ $sponsor->jumlah_sponsor }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Terbilang</label>
                        <input type="text" class="form-control" id="terbilang" name="terbilang" readonly>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Perbaharui</button>
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

            $('#jumlah_sponsor').on('blur', function() {
                const amount = $(this).val();
                const words = convertToWords(parseInt(amount, 10));
                $('#terbilang').val(words);
            });

            $('#sponsorship_id').change(function() {
                if ($(this).val().indexOf('lainnya') !== -1) {
                    $('#lainnya_div').show();
                } else {
                    $('#lainnya_div').hide();
                }
            }).trigger('change');
        });
    </script>
@endsection
