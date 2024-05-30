@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Data Orang Tua/Wali</h2>
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
                <form action="{{ route('admin.orangTuaWali.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="anak_id">Nama Anak<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="anak_id" name="anak_id" >
                            <option value="" disabled selected>-- Nama Anak --</option>
                            @foreach ($anak as $anakItem)
                                <option value="{{ $anakItem->id }}">{{ $anakItem->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="agama_id">Agama<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="agama_id" name="agama_id" >
                            <option value="" disabled selected>-- Pilih Agama --</option>
                            @foreach ($agama as $agamaItem)
                                <option value="{{ $agamaItem->id }}">{{ $agamaItem->agama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>
                    <hr>
                    <div style="text-align: left; position: relative; top: -10px;">
                        <span style="color: rgb(255, 9, 9);">Data Diri Ibu</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nik_ibu">NIK Ibu</label>
                                <input type="text" class="form-control" id="nik_ibu" name="nik_ibu" maxlength="16">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                                <input type="date" class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="no_hp_ibu">No. HP Ibu</label>
                                <input type="text" class="form-control" id="no_hp_ibu" name="no_hp_ibu" maxlength="13">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_ibu_id">Pendidikan ibu</label>
                                <select class="form-control js-example-basic-single" id="pendidikan_ibu_id"
                                    name="pendidikan_ibu_id">
                                    <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                    @foreach ($pendidikan as $pendidikanItem)
                                        <option value="{{ $pendidikanItem->id }}">{{ $pendidikanItem->tingkat_pendidikan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="pekerjaan_ibu_id">Pekerjaan Ibu</label>
                                <select class="form-control js-example-basic-single" id="pekerjaan_ibu_id"
                                    name="pekerjaan_ibu_id">
                                    <option value="" disabled selected>-- Pilih Jenis Pekerjaan --</option>
                                    @foreach ($pekerjaan as $pekerjaanItem)
                                        <option value="{{ $pekerjaanItem->id }}">{{ $pekerjaanItem->jenis_pekerjaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <hr>
                    <div style="text-align: left; position: relative; top: -10px;">
                        <span style="color: rgb(255, 9, 9);">Data Diri Ayah</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nik_ayah">NIK Ayah</label>
                                <input type="text" class="form-control" id="nik_ayah" name="nik_ayah" maxlength="16">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                                <input type="date" class="form-control" id="tanggal_lahir_ayah"
                                    name="tanggal_lahir_ayah">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="no_hp_ayah">No. HP Ayah</label>
                                <input type="text" class="form-control" id="no_hp_ayah" name="no_hp_ayah" maxlength="13">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_ayah_id">Pendidikan Ayah</label>
                                <select class="form-control js-example-basic-single" id="pendidikan_ayah_id"
                                    name="pendidikan_ayah_id">
                                    <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                    @foreach ($pendidikan as $pendidikanItem)
                                        <option value="{{ $pendidikanItem->id }}">
                                            {{ $pendidikanItem->tingkat_pendidikan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="pekerjaan_ayah_id">Pekerjaan Ayah</label>
                                <select class="form-control js-example-basic-single" id="pekerjaan_ayah_id"
                                    name="pekerjaan_ayah_id">
                                    <option value="" disabled selected>-- Pilih Jenis Pekerjaan --</option>
                                    @foreach ($pekerjaan as $pekerjaanItem)
                                        <option value="{{ $pekerjaanItem->id }}">{{ $pekerjaanItem->jenis_pekerjaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat_orangtua">Alamat Orangtua</label>
                        <input type="text" class="form-control" id="alamat_orangtua" name="alamat_orangtua">
                    </div>

                    <hr><hr>

                    <div style="text-align: left; position: relative; top: -10px;">
                        <span style="color: rgb(255, 9, 9);">Data Diri Wali</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_wali">Nama Wali</label>
                                <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="no_hp_wali">No. HP Wali</label>
                                <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" maxlength="13">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_wali">Tanggal Lahir Wali</label>
                                <input type="date" class="form-control" id="tanggal_lahir_wali"
                                    name="tanggal_lahir_wali">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="pekerjaan_wali_id">Pekerjaan Wali</label>
                                <select class="form-control js-example-basic-single" id="pekerjaan_wali_id"
                                    name="pekerjaan_wali_id">
                                    <option value="" disabled selected>-- Pilih Jenis Pekerjaan --</option>
                                    @foreach ($pekerjaan as $pekerjaanItem)
                                        <option value="{{ $pekerjaanItem->id }}">{{ $pekerjaanItem->jenis_pekerjaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_wali">Alamat Wali</label>
                        <input type="text" class="form-control" id="alamat_wali" name="alamat_wali">
                    </div>

                    <hr>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
