@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Anak</h2>
        <form action="{{ route('anak.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" class="form-control" name="nama_lengkap" required>
            </div>
            <div class="form-group">
                <label for="agama_id">Agama</label>
                <select class="form-control" id="agama_id" name="agama_id" required>
                    <option value="" disabled selected>-- Pilih Agama --</option>
                    @foreach ($agama as $agamaItem)
                        <option value="{{ $agamaItem->id }}">{{ $agamaItem->agama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin_id">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin_id" name="jenis_kelamin_id" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    @foreach ($jenisKelamin as $jenisKelaminItem)
                        <option value="{{ $jenisKelaminItem->id }}">{{ $jenisKelaminItem->jenis_kelamin }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="golongan_darah_id">Golongan Darah</label>
                <select class="form-control" id="golongan_darah_id" name="golongan_darah_id" required>
                    <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                    @foreach ($golonganDarah as $golonganDarahItem)
                        <option value="{{ $golonganDarahItem->id }}">{{ $golonganDarahItem->golongan_darah }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kebutuhan_id">Jenis Kebutuhan</label>
                <select class="form-control" id="kebutuhan_id" name="kebutuhan_id" required>
                    <option value="" disabled selected>-- Pilih Jenis Kebutuhan --</option>
                    @foreach ($kebutuhan as $kebutuhanItem)
                        <option value="{{ $kebutuhanItem->id }}">{{ $kebutuhanItem->jenis_kebutuhan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" class="form-control" name="tempat_lahir" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" name="tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" class="form-control" name="tanggal_masuk">
            </div>
            <div class="form-group">
                <label for="tanggal_keluar">Tanggal Keluar:</label>
                <input type="date" class="form-control" name="tanggal_keluar">
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
            <div class="form-group">
                <label for="penyakit_id">Penyakit</label>
                <select class="form-control" id="penyakit_id" name="penyakit_id">
                    <option value="" disabled selected>-- Pilih Penyakit --</option>
                    @foreach ($penyakit as $penyakitItem)
                        <option value="{{ $penyakitItem->id }}">{{ $penyakitItem->jenis_penyakit }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
