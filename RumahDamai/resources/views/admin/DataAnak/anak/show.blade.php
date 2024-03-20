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

                <p><strong>Nama Lengkap:</strong> {{ $anak->nama_lengkap }}</p>
                <p><strong>Agama:</strong> {{ $anak->agama->agama }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $anak->jenisKelamin->jenis_kelamin }}</p>
                <p><strong>Golongan Darah:</strong> {{ $anak->golonganDarah->golongan_darah }}</p>
                <p><strong>Kebutuhan:</strong> {{ $anak->kebutuhan->jenis_kebutuhan }}</p>
                <p><strong>Tempat Lahir:</strong> {{ $anak->tempat_lahir }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $anak->tanggal_lahir }}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $anak->tanggal_masuk }}</p>
                <p><strong>Tanggal Keluar:</strong> {{ $anak->tanggal_keluar }}</p>
                <p><strong>Disukai:</strong> {{ $anak->disukai }}</p>
                <p><strong>Tidak Disukai:</strong> {{ $anak->tidak_disukai }}</p>
                <p><strong>Alamat:</strong> {{ $anak->alamat }}</p>
                <p><strong>Kelebihan:</strong> {{ $anak->kelebihan }}</p>
                <p><strong>Kekurangan:</strong> {{ $anak->kekurangan }}</p>
                <p><strong>Penyakit:</strong> {{ optional($anak->penyakit)->jenis_penyakit }}</p>

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
