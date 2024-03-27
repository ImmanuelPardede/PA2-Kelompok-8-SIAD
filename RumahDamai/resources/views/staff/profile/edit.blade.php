@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Edit Profil Anda</h1>
        <form action="{{ route('staff.profile.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="{{ $user->nama_lengkap }}">
            </div>
        
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>
    
            <div class="form-group">
                <label for="nip">NIP:</label>
                <input type="text" name="nip" id="nip" class="form-control" value="{{ $user->nip }}">
            </div>
        
            <div class="form-group">
                <label for="golongan_darah_id">Golongan Darah:</label>
                <input type="text" name="golongan_darah_id" id="golongan_darah_id" class="form-control" value="{{ $user->golongan_darah_id }}">
            </div>
        
            <div class="form-group">
                <label for="jenis_kelamin_id">Jenis Kelamin:</label>
                <input type="text" name="jenis_kelamin_id" id="jenis_kelamin_id" class="form-control" value="{{ $user->jenis_kelamin_id }}">
            </div>
        
            <div class="form-group">
                <label for="agama_id">Agama:</label>
                <input type="text" name="agama_id" id="agama_id" class="form-control" value="{{ $user->agama_id }}">
            </div>
        
            <div class="form-group">
                <label for="pendidikan_id">Pendidikan:</label>
                <input type="text" name="pendidikan_id" id="pendidikan_id" class="form-control" value="{{ $user->pendidikan_id }}">
            </div>
        
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $user->alamat }}">
            </div>
        
            <div class="form-group">
                <label for="tanggal_keluar">Tanggal Keluar:</label>
                <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control" value="{{ $user->tanggal_keluar }}">
            </div>
        
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ $user->tempat_lahir }}">
            </div>
        
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $user->tanggal_lahir }}">
            </div>
        
            
            <div class="form-group">
                <label for="lokasi_penugasan_id">Lokasi Penugasan:</label>
                <input type="text" name="lokasi_penugasan_id" id="lokasi_penugasan_id" class="form-control" value="{{ $user->lokasi_penugasan_id }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
