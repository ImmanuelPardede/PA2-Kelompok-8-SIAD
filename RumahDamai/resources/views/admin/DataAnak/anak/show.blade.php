@extends('layouts.master')

@section('content')
    <div class="container">
        <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#home">Data Anak</a></li>
            <li><a data-toggle="pill" href="#menu1">Orang Tua</a></li>
            <li><a data-toggle="pill" href="#menu2">Menu 2</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade show active">
                <h2>Detail Anak</h2>

                <p><strong>Foto Profil:</strong></p>
                @if ($anak->foto_profil)
                    <img src="{{ asset($anak->foto_profil) }}" alt="Foto Profil Anak" class="w-25">
                @else
                    <p>Tidak ada foto profil.</p>
                @endif

                <p><strong>Nama Lengkap:</strong> {{ $anak->nama_lengkap ?? 'Data tidak tersedia'}}</p>
                <p><strong>Agama:</strong> {{ $anak->agama->agama ?? 'Data tidak tersedia'}}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $anak->jenisKelamin->jenis_kelamin ?? 'Data tidak tersedia'}}</p>
                <p><strong>Golongan Darah:</strong> {{ $anak->golonganDarah->golongan_darah ?? 'Data tidak tersedia'}}</p>
                <p><strong>Kebutuhan:</strong> {{ $anak->kebutuhan->jenis_kebutuhan ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tempat Lahir:</strong> {{ $anak->tempat_lahir ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $anak->tanggal_lahir ?? 'Data tidak tersedia'}}</p>
                <p><strong>Disukai:</strong> {{ $anak->disukai ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tidak Disukai:</strong> {{ $anak->tidak_disukai ?? 'Data tidak tersedia'}}</p>
                <p><strong>Alamat:</strong> {{ $anak->alamat ?? 'Data tidak tersedia'}}</p>
                <p><strong>Kelebihan:</strong> {{ $anak->kelebihan ?? 'Data tidak tersedia'}}</p>
                <p><strong>Kekurangan:</strong> {{ $anak->kekurangan ?? 'Data tidak tersedia'}}</p>
                <p><strong>Penyakit:</strong> {{ optional($anak->penyakit)->jenis_penyakit ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $anak->tanggal_masuk ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tanggal Keluar:</strong> {{ $anak->tanggal_keluar ?? 'Data tidak tersedia'}}</p>
                <p><strong>Status:</strong> {{ $anak->status ?? 'Data tidak tersedia'}}</p>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>

            </div>
        </div>

    </div>
@endsection
