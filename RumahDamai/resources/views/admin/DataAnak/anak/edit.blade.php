@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Anak</h2>

        <p><strong>Foto Profil:</strong></p>
        @if ($anak->foto_profil)
            <img src="{{ asset($anak->foto_profil) }}" alt="Foto Profil">
            <strong>Foto Profil:</strong> {{ $anak->foto_profil }}
        @else
            <p>Tidak ada foto profil.</p>
        @endif

        <form action="{{ route('anak.update', $anak->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="foto_profil">Foto Profil Baru:</label>
                <input type="file" class="form-control" id="foto_profil" name="foto_profil">
            </div>

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                    value="{{ $anak->nama_lengkap }}" required>
            </div>

            <div class="form-group">
                <label for="agama_id">Agama:</label>
                <select class="form-control" id="agama_id" name="agama_id" required>
                    <option value="" disabled>-- Pilih Agama --</option>
                    @foreach ($agama as $agamalist)
                        <option value="{{ $agamalist->id }}" {{ $anak->agama_id == $agamalist->id ? 'selected' : '' }}>
                            {{ $agamalist->agama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin_id">Jenis Kelamin:</label>
                <select class="form-control" id="jenis_kelamin_id" name="jenis_kelamin_id" required>
                    <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                    @foreach ($jenisKelamin as $kelaminlist)
                        <option value="{{ $kelaminlist->id }}"
                            {{ $anak->jenis_kelamin_id == $kelaminlist->id ? 'selected' : '' }}>
                            {{ $kelaminlist->jenis_kelamin }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="golongan_darah_id">Golongan Darah:</label>
                <select class="form-control" id="golongan_darah_id" name="golongan_darah_id" required>
                    <option value="" disabled>-- Pilih Golongan Darah --</option>
                    @foreach ($golonganDarah as $darahlist)
                        <option value="{{ $darahlist->id }}"
                            {{ $anak->golongan_darah_id == $darahlist->id ? 'selected' : '' }}>
                            {{ $darahlist->golongan_darah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kebutuhan_id">Kebutuhan:</label>
                <select class="form-control" id="kebutuhan_id" name="kebutuhan_id" required>
                    <option value="" disabled>-- Pilih Kebutuhan --</option>
                    @foreach ($kebutuhan as $kebutuhanlist)
                        <option value="{{ $kebutuhanlist->id }}"
                            {{ $anak->kebutuhan_id == $kebutuhanlist->id ? 'selected' : '' }}>
                            {{ $kebutuhanlist->jenis_kebutuhan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                    value="{{ $anak->tempat_lahir }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                    value="{{ $anak->tanggal_lahir }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
                    value="{{ $anak->tanggal_masuk }}">
            </div>

            <div class="form-group">
                <label for="tanggal_keluar">Tanggal Keluar:</label>
                <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
                    value="{{ $anak->tanggal_keluar }}">
            </div>

            <div class="form-group">
                <label for="disukai">Disukai:</label>
                <input type="text" class="form-control" id="disukai" name="disukai" value="{{ $anak->disukai }}">
            </div>

            <div class="form-group">
                <label for="tidak_disukai">Tidak Disukai:</label>
                <input type="text" class="form-control" id="tidak_disukai" name="tidak_disukai"
                    value="{{ $anak->tidak_disukai }}">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $anak->alamat }}</textarea>
            </div>

            <div class="form-group">
                <label for="kelebihan">Kelebihan:</label>
                <textarea class="form-control" id="kelebihan" name="kelebihan" rows="3">{{ $anak->kelebihan }}</textarea>
            </div>

            <div class="form-group">
                <label for="kekurangan">Kekurangan:</label>
                <textarea class="form-control" id="kekurangan" name="kekurangan" rows="3">{{ $anak->kekurangan }}</textarea>
            </div>

            <div class="form-group">
                <label for="penyakit_id">Penyakit:</label>
                <select class="form-control" id="penyakit_id" name="penyakit_id">
                    <option value="" disabled>-- Pilih Penyakit --</option>
                    @foreach ($penyakit as $penyakitlist)
                        <option value="{{ $penyakitlist->id }}"
                            {{ $anak->penyakit_id == $penyakitlist->id ? 'selected' : '' }}>
                            {{ $penyakitlist->jenis_penyakit }}
                        </option>
                    @endforeach
                </select>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
