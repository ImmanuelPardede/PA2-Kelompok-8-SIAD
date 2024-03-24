@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Donatur</h4>
                <p class="card-description">Donatur?</p>
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Jenis Donasi:</th>
                                        <td>
                                            @if ($donatur->donasi->count() > 0)
                                                @foreach ($donatur->donasi as $jenis_donasi)
                                                    {{ $jenis_donasi->jenis_donasi }},
                                                @endforeach
                                            @else
                                                Data tidak tersedia
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Nama Donatur:</th>
                                        <td>{{ $donatur->nama_donatur ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Donatur:</th>
                                        <td>{{ $donatur->email_donatur ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. Hp Donatur:</th>
                                        <td>{{ $donatur->no_hp_donatur ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Donasi:</th>
                                        <td>{{ $donatur->jumlah_donasi ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="image-frame">
                            @if ($donatur->foto_donatur)
                                <img src="{{ asset($donatur->foto_donatur) }}" alt="Foto Donatur" class="img-fluid rounded">
                            @else
                                <p>Tidak ada foto Donatur.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
