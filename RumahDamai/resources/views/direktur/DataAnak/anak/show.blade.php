@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Anak</h4>

                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table" style="max-width: 100%;">
                                <tbody>
                                    <tr>
                                        <th class="small-text">Nama Lengkap</th>
                                        <td>{{ $anak->nama_lengkap ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">NIA</th>
                                        <td>{{ $anak->nia ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Agama</th>
                                        <td>{{ $anak->agama->agama ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Jenis Kelamin</th>
                                        <td>{{ $anak->jenisKelamin->jenis_kelamin ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Golongan Darah</th>
                                        <td>{{ $anak->golonganDarah->golongan_darah ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    @if ($anak->tipe_anak == 'disabilitas')
                                        <tr>
                                            <th class="small-text">Kebutuhan Disabilitas</th>
                                            <td>{{ $anak->kebutuhanDisabilitas->jenis_kebutuhan_disabilitas ?? 'Data tidak tersedia' }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="small-text">Tempat Lahir</th>
                                        <td>{{ $anak->tempat_lahir ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Tanggal Lahir</th>
                                        <td>{{ $anak->tanggal_lahir ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Tanggal Masuk</th>
                                        <td>{{ $anak->tanggal_masuk ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Tanggal Keluar</th>
                                        <td>{{ $anak->tanggal_keluar ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Alamat</th>
                                        <td>{{ $anak->alamat ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Tempat Yayasan</th>
                                        <td>{{ optional($anak->lokasiTugas)->lokasi ?? 'Data tidak tersedia' }}
                                        </td>
                                    </tr><br>

                                    <tr>
                                        <th class="small-text">Status</th>
                                        <td>{{ $anak->status ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Disukai</th>
                                        <td>{!! $anak->disukai ?? 'Data tidak tersedia' !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Tidak Disukai</th>
                                        <td>{!! $anak->tidak_disukai ?? 'Data tidak tersedia' !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Kelebihan</th>
                                        <td>{!! $anak->kelebihan ?? 'Data tidak tersedia' !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="small-text">Kekurangan</th>
                                        <td>{!! $anak->kekurangan ?? 'Data tidak tersedia' !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="image-container">
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
                <div style="form-group d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    <a href="{{ route('direktur.anak.pdf', ['id' => $anak->id]) }}" class="btn btn-success">Generate
                        PDF</a>
                    <div style="float: right;">

                        @if ($anak->status === 'aktif')
                            <form action="{{ route('direktur.anak.nonaktifkan', $anak->id) }}" method="post"
                                style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menonaktifkan?')">NonAktifkan Anak</button>
                            </form>
                        @else
                            <form action="{{ route('direktur.anak.aktifkan', $anak->id) }}" method="post"
                                style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirm('Yakin ingin mengaktifkan?')">Aktifkan Anak</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
