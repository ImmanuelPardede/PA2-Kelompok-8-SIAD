<!-- resources/views/admin/administrator/create.blade.php -->
@extends('layouts.master')

@section('content')
    <h1>Tambah Akun Baru</h1>

    <form action="{{ route('admin.administrator.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control js-example-basic-single" name="role" id="role" class="form-control" required>
                <option value="" disabled selected>-- Pilih Role Pekerjaan --</option>
                <option value="admin">Admin</option>
                <option value="guru" >Guru</option>
                <option value="staff">Staff</option>
            </select>
        </div>

        <div class="form-group">
            <label for="lokasi_penugasan_id">Lokasi Penugasan:</label>
            <select class="form-control js-example-basic-single" id="lokasi_penugasan_id" name="lokasi_penugasan_id">
                <option value="" disabled selected>-- Pilih Lokasi Penugasan --</option>
                @foreach ($lokasi as $lokasilist)
                <option value="{{ $lokasilist->id }}">{{ $lokasilist->lokasi }}</option>
                @endforeach
            </select>
        </div>


        
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection
