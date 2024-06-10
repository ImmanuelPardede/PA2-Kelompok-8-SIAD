@extends('layouts.management.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Data Donatur</h1>
            <div class="image-frame">
                @if ($donatur->foto_donatur)
                    <img src="{{ asset($donatur->foto_donatur) }}" alt="Foto Donatur" class="img-fluid"
                         style="width: 400px; height: auto; display: block; margin: auto;">
                @else
                    <p>Tidak ada foto Donatur.</p>
                @endif
            </div>
            <form action="{{ route('dataDonatur.update', $donatur->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="foto_donatur">Foto Donasi Baru</label>
                    <input type="file" class="form-control" id="foto_donatur" name="foto_donatur">
                </div>

                <div class="form-group">
                    <label for="donasi_id">Jenis Donasi</label>
                    <select class="form-control js-example-basic-multiple" id="donasi_id" name="donasi_id[]" multiple>
                        @foreach ($donasi as $donasiItem)
                            <option value="{{ $donasiItem->id }}"
                                {{ in_array($donasiItem->id, old('donasi_id', $selectedDonasiIds)) ? 'selected' : '' }}>
                                {{ $donasiItem->jenis_donasi }}
                            </option>
                        @endforeach
                        <option value="lainnya"
                            {{ in_array('lainnya', old('donasi_id', $selectedDonasiIds)) ? 'selected' : '' }}>
                            Pilihan Lainnya
                        </option>
                    </select>
                </div>

                <div class="form-group" id="lainnya_div"
                    style="{{ in_array('lainnya', old('donasi_id', $selectedDonasiIds)) ? '' : 'display:none;' }}">
                    <label for="lainnya">Jenis Donasi Lainnya</label>
                    <input type="text" class="form-control" id="lainnya" name="lainnya"
                        value="{{ old('lainnya', $donatur->lainnya ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="nama_donatur">Nama Donatur</label>
                    <input type="text" class="form-control" id="nama_donatur" name="nama_donatur"
                        value="{{ old('nama_donatur', $donatur->nama_donatur) }}">
                </div>

                <div class="form-group">
                    <label for="email_donatur">Email Donatur</label>
                    <input type="text" class="form-control" id="email_donatur" name="email_donatur"
                        value="{{ old('email_donatur', $donatur->email_donatur) }}">
                </div>

                <div class="form-group">
                    <label for="tanggal_donatur">Tanggal Donasi</label>
                    <input type="date" class="form-control" id="tanggal_donatur" name="tanggal_donatur"
                        value="{{ old('tanggal_donatur', $donatur->tanggal_donatur) }}">
                </div>

                <div class="form-group">
                    <label for="no_hp_donatur">No. Hp Donatur</label>
                    <input type="text" class="form-control" id="no_hp_donatur" name="no_hp_donatur"
                        value="{{ old('no_hp_donatur', $donatur->no_hp_donatur) }}">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                        value="{{ old('deskripsi', $donatur->deskripsi) }}">
                </div>

                <div class="form-group">
                    <label for="jumlah_donasi">Jumlah Donasi</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="height: 100%;">Rp</span>
                        </div>
                        <input type="text" class="form-control" id="jumlah_donasi" name="jumlah_donasi"
                            value="{{ old('jumlah_donasi', $donatur->jumlah_donasi) }}">
                    </div>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" id="submitButton" class="btn btn-success mr-2">Perbaharui</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#donasi_id').change(function() {
            if ($(this).val().indexOf('lainnya') !== -1) {
                $('#lainnya_div').show();
            } else {
                $('#lainnya_div').hide();
                $('#lainnya').val('');  // Clear the value of 'lainnya' field if not selected
            }
        }).trigger('change');
    });
</script>
@endsection
