@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Anak</h2>
        <form action="{{ route('anak.update', $anak->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="namaLengkap">Nama Lengkap:</label>
                <input type="text" class="form-control" name="namaLengkap" value="{{ $anak->namaLengkap }}" required>
            </div>
            <div class="form-group">
                <label for="agama_id">Agama</label>
                <select class="form-control" id="agama_id" name="agama_id" required>
                    <option value="" disabled>Pilih Agama</option>
                    @foreach ($agama as $agamalist)
                        <option value="{{ $agamalist->id }}" {{ $anak->agama_id == $agamalist->id ? 'selected' : '' }}>
                            {{ $agamalist->agama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin_id">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin_id" name="jenis_kelamin_id" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    @foreach ($jenisKelamin as $kelaminlist)
                        <option value="{{ $kelaminlist->id }}"  {{ $anak->jenis_kelamin_id == $kelaminlist->id ? 'selected' : '' }}>{{ $kelaminlist->jenis_kelamin }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="golongan_darah_id">Golongan Darah</label>
                <select class="form-control" id="golongan_darah_id" name="golongan_darah_id" required>
                    <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                    @foreach ($golonganDarah as $darahlist)
                        <option value="{{ $darahlist->id }}" {{ $anak->golongan_darah_id == $darahlist->id ? 'selected' : '' }}> {{ $darahlist->golongan_darah }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="kebutuhan_id">Jenis Kebutuhan</label>
                <select class="form-control" id="kebutuhan_id" name="kebutuhan_id" required>
                    <option value="" disabled selected>-- Pilih Jenis Kebutuhan --</option>
                    @foreach ($kebutuhan as $kebutuhanlist)
                        <option value="{{ $kebutuhanlist->id }}" {{ $anak->kebutuhan_id == $kebutuhanlist->id ? 'selected' : '' }}>{{ $kebutuhanlist->jenis_kebutuhan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tempatLahir">Tempat Lahir:</label>
                <input type="text" class="form-control" name="tempatLahir" value="{{ $anak->tempatLahir }}" required>
            </div>
            <div class="form-group">
                <label for="tanggalLahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" name="tanggalLahir" value="{{ $anak->tanggalLahir }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
