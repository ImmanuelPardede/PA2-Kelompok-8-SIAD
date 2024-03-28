@extends('layouts.master')

@section('content')
<div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profil Anda</h5>
                <p class="card-text"><strong>Nama Lengkap:</strong> {{ $user->nama_lengkap }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>NIP:</strong> {{ $user->nip }}</p>
                <p class="card-text"><strong>Golongan Darah:</strong> 
                    @if ($user->golongan_darah_id)
                        {{ $golongandarah->where('id', $user->golongan_darah_id)->first()->golongan_darah }}
                    @else
                        Golongan darah tidak tersedia.
                    @endif
                </p>
                <p class="card-text"><strong>Jenis Kelamin:</strong> 
                    @if ($user->jenis_kelamin_id)
                        {{ $jeniskelamin->where('id', $user->jenis_kelamin_id)->first()->jenis_kelamin }}
                    @else
                        Jenis kelamin tidak tersedia.
                    @endif
                </p>
                                                <p class="card-text"><strong>Agama:</strong> 
                                    @if ($user->agama_id)
                                        {{ $agama->where('id', $user->agama_id)->first()->agama }}
                                    @else
                                        Agama tidak tersedia.
                                    @endif
                                </p>
                                                <p class="card-text"><strong>pendidikan:</strong> 
                    @if ($user->pendidikan_id)
                        {{ $pendidikan->where('id', $user->pendidikan_id)->first()->tingkat_pendidikan }}
                    @else
                        Pendidikan tidak tersedia.
                    @endif
                </p>
                <p class="card-text"><strong>alamat:</strong> {{ $user->alamat }}</p>
                <p class="card-text"><strong>Mulai Kerja:</strong> {{ $user->tanggal_masuk }}</p>
                <p class="card-text"><strong>tempat lahir:</strong> {{ $user->tempat_lahir }}</p>
                <p class="card-text"><strong>tanggal lahir:</strong> {{ $user->tanggal_lahir }}</p>
                <p class="card-text"><strong>Lokasi Penugasan:</strong> 
                    @if ($user->lokasi_penugasan_id)
                        {{ $lokasi->where('id', $user->lokasi_penugasan_id)->first()->lokasi }}
                    @else
                        Lokasi penugasan tidak tersedia.
                    @endif
                </p>

                @if ($user->foto)
                <img src="{{ asset('uploads/pegawai/' . $user->foto) }}" alt="Foto Profil">
            @else
                <p>Foto Profil tidak tersedia</p>
            @endif
                
                <!-- Tambahkan informasi profil tambahan sesuai kebutuhan -->
                <a href="{{ route('staff.profile.edit', ['user' => $user->id]) }}" class="btn btn-primary">Edit Profil</a>
            </div>
        </div>
    </div>
@endsection
