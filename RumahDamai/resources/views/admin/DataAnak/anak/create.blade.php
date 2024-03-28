@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Tambah Anak</h2>
            <form action="{{ route('anak.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap:</label>
                    <input type="text" class="form-control" name="nama_lengkap">
                </div>
                <div class="form-group">
                    <label for="agama_id">Agama</label>
                    <select class="form-control js-example-basic-single" id="agama_id" name="agama_id">
                        <option value="" disabled selected>-- Pilih Agama --</option>
                        @foreach ($agama as $agamaItem)
                            <option value="{{ $agamaItem->id }}">{{ $agamaItem->agama }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <label for="jenis_kelamin_id">Jenis Kelamin</label>
                    <select class="form-control js-example-basic-single" id="jenis_kelamin_id" name="jenis_kelamin_id">
                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                        @foreach ($jenisKelamin as $jenisKelaminItem)
                            <option value="{{ $jenisKelaminItem->id }}">{{ $jenisKelaminItem->jenis_kelamin }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="golongan_darah_id">Golongan Darah</label>
                    <select class="form-control js-example-basic-single " id="golongan_darah_id" name="golongan_darah_id">
                        <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                        @foreach ($golonganDarah as $golonganDarahItem)
                            <option value="{{ $golonganDarahItem->id }}">{{ $golonganDarahItem->golongan_darah }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kebutuhan_disabilitas_id">Jenis Kebutuhan Disabilitas</label>
                    <select class="form-control js-example-basic-single" id="kebutuhan_disabilitas_id" name="kebutuhan_disabilitas_id">
                        <option value="" disabled selected>-- Pilih Jenis Kebutuhan Disabilitas --</option>
                        @foreach ($kebutuhanDisabilitas as $kebutuhanDisabilitasItem)
                            @if ($kebutuhanDisabilitasItem && $kebutuhanDisabilitasItem->jenis_kebutuhan_disabilitas) <!-- Check if the item and its property are not null -->
                                <option value="{{ $kebutuhanDisabilitasItem->id }}">{{ $kebutuhanDisabilitasItem->jenis_kebutuhan_disabilitas }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir:</label>
                    <input type="text" class="form-control" name="tempat_lahir">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" class="form-control" name="tanggal_lahir">
                </div>
                <div class="form-group">
                    <label for="disukai">Disukai:</label>
                    <textarea class="form-control" name="disukai" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="tidak_disukai">Tidak Disukai:</label>
                    <textarea class="form-control" name="tidak_disukai" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" name="alamat">
                </div>
                <div class="form-group">
                    <label for="kelebihan">Kelebihan:</label>
                    <textarea class="form-control" name="kelebihan" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="kekurangan">Kekurangan:</label>
                    <textarea class="form-control" name="kekurangan" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="foto_profil">Foto Profil:</label>
                    <input type="file" class="form-control" name="foto_profil">
                    <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
