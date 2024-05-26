@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail PPI Model B</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th for="anak">Nama Anak:</th>
                                        <td>
                                            @if ($ppiB->anak->nama_lengkap)
                                                {{ $ppiB->anak->nama_lengkap }}
                                            @else
                                                Data Tidak Tersedia
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th for="file_ppi_b">File PPI B:</th>
                                        <td>
                                            @if ($ppiB->file_ppi_b)
                                                <a href="{{ route('ppiB.downloadPpiB', $ppiB->id) }}">{{ $ppiB->file_ppi_b }}</a>
                                            @else
                                                Data tidak tersedia
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th for="deskripsi">Deskripsi:</th>
                                        <td>
                                            @if ($ppiB->deskripsi)
                                                {!! nl2br(e($ppiB->deskripsi)) !!}
                                            @else
                                                Data tidak tersedia
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('ppiB.index') }}" class="btn btn-primary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
