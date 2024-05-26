@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Riwayat Medis</h4>
                <div class="row">
                    <div class="col-md">
                        <div class="table-responsive">
                            <table class="table" style="max-width: 100%;">
                                <tbody>
                                    <tr>
                                        <th>Riwayat Perawatan:</th>
                                        <td>{{ $riwayatmedis->riwayat_perawatan ?? 'Data tidak tersedia' }}
                                        <td>
                                    </tr>
                                    <tr>
                                        <th>Riwayat Perilaku:</th>
                                        <td>{{ $riwayatmedis->riwayat_perilaku ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi Riwayat:</th>
                                        <td>{{ $riwayatmedis->deskripsi_riwayat ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kondisi:</th>
                                        <td>{{ $riwayatmedis->kondisi ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
