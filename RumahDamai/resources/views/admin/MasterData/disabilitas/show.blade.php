@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Jenis Disabilitas</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Kategori Disabilitas:</th>
                                        <td>{{ $disabilitas->kategori_disabilitas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Disabilitas:</th>
                                        <td>{{ $disabilitas->jenis_disabilitas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi:</th>
                                        <td>{{ $disabilitas->deskripsi ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
