@extends('layouts.master')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Anak</h4>
                <p class="card-description">
                    Orang tua? </p>
                <div class="row">
                    <div class="col-md-8">

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                    <th>Nama Lengkap</th>
                                    <td>{{ $anak->nama_lengkap ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>{{ $anak->agama->agama ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $anak->jenisKelamin->jenis_kelamin ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Golongan Darah</th>
                                        <td>{{ $anak->golonganDarah->golongan_darah ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Kebutuhan</th>
                                        <td>{{ $anak->kebutuhan->jenis_kebutuhan ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td>{{ $anak->tempat_lahir ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{ $anak->tanggal_lahir ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Masuk</th>
                                        <td>{{ $anak->tanggal_masuk ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Keluar</th>
                                        <td>{{ $anak->tanggal_keluar ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Disukai</th>
                                        <td>{{ $anak->disukai ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tidak Disukai</th>
                                        <td>{{ $anak->tidak_disukai ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $anak->alamat ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelebihan</th>
                                        <td>{{ $anak->kelebihan ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Kekurangan</th>
                                        <td>{{ $anak->kekurangan ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Penyakit</th>
                                        <td>{{ optional($anak->penyakit)->jenis_penyakit ?? 'Data tidak tersedia'}}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>


                    </div>
                    <div class="col-md-4">
                        <div class="image-frame">
                            @if ($anak->foto_profil)
                                <img src="{{ asset($anak->foto_profil) }}" alt="Foto Profil Anak"
                                    class="img-fluid rounded">
                            @else
                                <p>Tidak ada foto profil.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
