@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Data Orang Tua/Wali</h2>
        <form action="{{ route('orangTuaWali.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="anak_id">Nama Anak</label>
                <select class="form-control" id="anak_id" name="anak_id" required>
                    <option value="" disabled selected>-- Nama Anak --</option>
                    @foreach ($anak as $anakItem)
                        <option value="{{ $anakItem->id }}">{{ $anakItem->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="agama_id">Agama:</label>
                <select class="form-control" id="agama_id" name="agama_id" required>
                    <option value="" disabled selected>-- Pilih Agama --</option>
                    @foreach ($agama as $agamaItem)
                        <option value="{{ $agamaItem->id }}">{{ $agamaItem->agama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu:</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
            </div>
            <div class="form-group">
                <label for="nama_ayah">Nama Ayah:</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
            </div>
            <div class="form-group">
                <label for="nik_ayah">NIK Ayah:</label>
                <input type="text" class="form-control" id="nik_ayah" name="nik_ayah" required>
            </div>
            <div class="form-group">
                <label for="nik_ibu">NIK Ibu:</label>
                <input type="text" class="form-control" id="nik_ibu" name="nik_ibu" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah:</label>
                <input type="date" class="form-control" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu:</label>
                <input type="date" class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu">
            </div>
            <div class="form-group">
                <label for="alamat_orangtua">Alamat Orangtua:</label>
                <input type="text" class="form-control" id="alamat_orangtua" name="alamat_orangtua">
            </div>
            <div class="form-group">
                <label for="pendidikan_ayah">Pendidikan Ayah:</label>
                <input type="text" class="form-control" id="pendidikan_ayah" name="pendidikan_ayah">
            </div>
            <div class="form-group">
                <label for="pekerjaan_ayah_id">Pekerjaan Ayah:</label>
                <select class="form-control" id="pekerjaan_ayah_id" name="pekerjaan_ayah_id">
                    <option value="" disabled selected>-- Pilih Jenis Pekerjaan --</option>
                    @foreach ($pekerjaan as $pekerjaanItem)
                        <option value="{{ $pekerjaanItem->id }}">{{ $pekerjaanItem->jenis_pekerjaan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp_ayah">No. HP Ayah:</label>
                <input type="text" class="form-control" id="no_hp_ayah" name="no_hp_ayah">
            </div>
            <div class="form-group">
                <label for="pendidikan_ibu">Pendidikan Ibu:</label>
                <input type="text" class="form-control" id="pendidikan_ibu" name="pendidikan_ibu">
            </div>
            <div class="form-group">
                <label for="pekerjaan_ibu_id">Pekerjaan Ibu:</label>
                <select class="form-control" id="pekerjaan_ibu_id" name="pekerjaan_ibu_id">
                    <option value="" disabled selected>-- Pilih Jenis Pekerjaan --</option>
                    @foreach ($pekerjaan as $pekerjaanItem)
                        <option value="{{ $pekerjaanItem->id }}">{{ $pekerjaanItem->jenis_pekerjaan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp_ibu">No. HP Ibu:</label>
                <input type="text" class="form-control" id="no_hp_ibu" name="no_hp_ibu">
            </div>
            <div class="form-group">
                <label for="nama_wali">Nama Wali:</label>
                <input type="text" class="form-control" id="nama_wali" name="nama_wali">
            </div>
            <div class="form-group">
                <label for="alamat_wali">Alamat Wali:</label>
                <input type="text" class="form-control" id="alamat_wali" name="alamat_wali">
            </div>
            <div class="form-group">
                <label for="pekerjaan_wali_id">Pekerjaan Wali:</label>
                <select class="form-control" id="pekerjaan_wali_id" name="pekerjaan_wali_id">
                    <option value="" disabled selected>-- Pilih Jenis Pekerjaan --</option>
                    @foreach ($pekerjaan as $pekerjaanItem)
                        <option value="{{ $pekerjaanItem->id }}">{{ $pekerjaanItem->jenis_pekerjaan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir_wali">Tanggal Lahir Wali:</label>
                <input type="date" class="form-control" id="tanggal_lahir_wali" name="tanggal_lahir_wali">
            </div>
            <div class="form-group">
                <label for="no_hp_wali">No. HP Wali:</label>
                <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
