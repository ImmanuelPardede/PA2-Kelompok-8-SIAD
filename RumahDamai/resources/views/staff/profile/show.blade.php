@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Profil Staff</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profil Anda</h5>
                <p class="card-text"><strong>Nama Lengkap:</strong> {{ $user->nama_lengkap }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>NIP:</strong> {{ $user->nip }}</p>
                <p class="card-text"><strong>Golongan Darah:</strong> {{ $user->golongan_darah_id }}</p>
                <p class="card-text"><strong>jenis kelamin </strong> {{ $user->jenis_kelamin_id }}</p>
                <p class="card-text"><strong>agama:</strong> {{ $user->agama_id }}</p>
                <p class="card-text"><strong>pendidikan:</strong> {{ $user->pendidikan_id }}</p>
                <p class="card-text"><strong>alamat:</strong> {{ $user->alamat }}</p>
                <p class="card-text"><strong>tanggal masuk:</strong> {{ $user->tanggal_masuk }}</p>
                <p class="card-text"><strong>tempat lahir:</strong> {{ $user->tempat_lahir }}</p>
                <p class="card-text"><strong>tanggal lahir:</strong> {{ $user->tanggal_lahir }}</p>
                <p class="card-text"><strong>lokasi penugasan :</strong> {{ $user->lokasi_penugasan_id }}</p>
                <a href="{{ route('staff.profile.edit', ['user' => $user->id]) }}" class="btn btn-primary">Edit Profil</a>
            </div>
        </div>
    </div>
@endsection
