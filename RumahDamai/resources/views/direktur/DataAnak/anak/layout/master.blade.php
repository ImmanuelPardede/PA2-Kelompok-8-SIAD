{{-- @include('admin.DataAnak.anak.layout.master') --}}


@extends('layouts.management.master')

@section('content')
    <style>
        .image-container {
            text-align: center;
        }

        .image-frame {
            display: inline-block;
            max-width: 60%;
        }

        .small-text {
            font-size: smaller;
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Anak</h4>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="data-anak-tab" data-bs-toggle="tab" data-bs-target="#data-anak"
                            type="button" role="tab" aria-controls="data-anak" aria-selected="true">Data Anak</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="peta-sejarah-tab" data-bs-toggle="tab" data-bs-target="#peta-sejarah"
                            type="button" role="tab" aria-controls="peta-sejarah" aria-selected="false">Peta
                            Sejarah/Latar Belakang</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="data-anak" role="tabpanel" aria-labelledby="data-anak-tab">
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
                        <br><br>
                        <div class="row">
                            <div class="col-sm">
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
                                            <tr>
                                                <th class="small-text">Kebutuhan Disabilitas</th>
                                                <td>{{ $anak->kebutuhanDisabilitas->jenis_kebutuhan_disabilitas ?? 'Data tidak tersedia' }}
                                                </td>
                                            </tr>
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
                        </div>
                        <hr><br>
                        <div class="col-sm">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                            @if ($anak->status === 'aktif')
                                <form action="{{ route('anak.nonaktifkan', $anak->id) }}" method="post"
                                    style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin menonaktifkan?')">NonAktif</button>
                                </form>
                            @else
                                <form action="{{ route('anak.aktifkan', $anak->id) }}" method="post"
                                    style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Yakin ingin mengaktifkan?')">Aktifkan</button>
                                </form>
                            @endif
                            <a href="{{ route('anak.pdf', ['id' => $anak->id]) }}" class="btn btn-primary">Generate PDF</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="peta-sejarah" role="tabpanel" aria-labelledby="peta-sejarah-tab">
                <!-- Konten untuk tab "Peta Sejarah/Latar Belakang" di sini -->
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
