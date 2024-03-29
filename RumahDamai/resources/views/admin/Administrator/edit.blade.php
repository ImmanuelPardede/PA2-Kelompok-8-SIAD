@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Akun</h1>
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

            <form action="{{ route('admin.administrator.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap:</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="{{ $user->nama_lengkap }}">
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control js-example-basic-single" name="role" id="role">
                        <option value="{{ $user->role }}" disabled selected>{{ $user->role }}</option>
                        <option value="0" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                        <option value="1" {{ $user->role == 'guru' ? 'selected' : '' }}>guru</option>
                        <option value="2" {{ $user->role == 'staff' ? 'selected' : '' }}>staff</option>
                    </select>
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
                    <select class="form-control js-example-basic-single" id="golongan_darah_id" name="golongan_darah_id">
                        <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                        @foreach ($golongandarah as $darahlist)
                        <option value="{{ $darahlist->id }}" {{ $user->golongan_darah_id == $darahlist->id ? 'selected' : '' }}>
                            {{ $darahlist->golongan_darah }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tambahkan bagian ini untuk jenis kelamin -->
                <div class="form-group">
                    <label for="jenis_kelamin_id">Jenis Kelamin:</label>
                    <select class="form-control js-example-basic-single" id="jenis_kelamin_id" name="jenis_kelamin_id">
                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                        @foreach ($jeniskelamin as $kelaminlist)
                        <option value="{{ $kelaminlist->id }}" {{ $user->jenis_kelamin_id == $kelaminlist->id ? 'selected' : '' }}>
                            {{ $kelaminlist->jenis_kelamin }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tambahkan bagian ini untuk agama -->
                <div class="form-group">
                    <label for="agama_id">Agama:</label>
                    <select class="form-control js-example-basic-single" id="agama_id" name="agama_id">
                        <option value="" disabled selected>-- Pilih Agama --</option>
                        @foreach ($agama as $agamalist)
                        <option value="{{ $agamalist->id }}" {{ $user->agama_id == $agamalist->id ? 'selected' : '' }}>
                            {{ $agamalist->agama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tambahkan bagian ini untuk pendidikan -->
                <div class="form-group">
                    <label for="pendidikan_id">Pendidikan:</label>
                    <select class="form-control js-example-basic-single" id="pendidikan_id" name="pendidikan_id">
                        <option value="" disabled selected>-- Pilih Pendidikan --</option>
                        @foreach ($pendidikan as $pendidikanlist)
                        <option value="{{ $pendidikanlist->id }}" {{ $user->pendidikan_id == $pendidikanlist->id ? 'selected' : '' }}>
                            {{ $pendidikanlist->tingkat_pendidikan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $user->alamat }}">
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
                    <select class="form-control js-example-basic-single" id="lokasi_penugasan_id" name="lokasi_penugasan_id">
                        <option value="" disabled selected>-- Pilih Lokasi Penugasan --</option>
                        @foreach ($lokasi as $lokasilist)
                        <option value="{{ $lokasilist->id }}" {{ $user->lokasi_penugasan_id == $lokasilist->id ? 'selected' : '' }}>
                            {{ $lokasilist->lokasi }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_keluar">Tanggal Keluar:</label>
                    <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control" value="{{ $user->tanggal_keluar }}">
                </div>

                <div class="form-group">
                    <label for="foto">Foto Profil Baru:</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>

                @if ($user->foto)
                <img src="{{ asset('uploads/pegawai/' . $user->foto) }}" alt="Foto Profil">
                @else
                <p>Foto Profil tidak tersedia</p>
                @endif

                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary mr-2">Perbarui</button>
                    <button class="btn btn-danger" type="button" id="change-password" data-toggle="modal" data-target="#passwordModal">Ganti Password</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.administrator.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newPassword">Password Baru:</label>
                        <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="Masukkan password baru">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
