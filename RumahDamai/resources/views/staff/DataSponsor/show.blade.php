@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Sponsor</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Jenis Sponsor</th>
                                        <td>
                                            @if ($sponsor->sponsorship->count() > 0 || $sponsor->lainnya)
                                                @php $sponsorshipCount = $sponsor->sponsorship->count(); @endphp
                                                @foreach ($sponsor->sponsorship as $index => $jenis_sponsorship)
                                                    @if ($sponsorshipCount > 1)
                                                        {{ $index + 1 }}.
                                                    @endif
                                                    {{ $jenis_sponsorship->jenis_sponsorship }} <br>
                                                @endforeach

                                                @if ($sponsor->lainnya)
                                                    @if ($sponsorshipCount > 1)
                                                        {{ $sponsorshipCount + 1 }}.
                                                    @endif
                                                    {{ $sponsor->lainnya }}
                                                @endif
                                            @else
                                                @if ($sponsor->lainnya)
                                                    {{ $sponsor->lainnya }}
                                                @else
                                                    Data tidak tersedia
                                                @endif
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Nama Sponsor</th>
                                        <td>{{ $sponsor->nama_sponsor ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Sponsor</th>
                                        <td>{{ $sponsor->email_sponsor ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Sponsor</th>
                                        <td>
                                            @php
                                                $bulanIndonesia = [
                                                    1 => 'Januari',
                                                    2 => 'Februari',
                                                    3 => 'Maret',
                                                    4 => 'April',
                                                    5 => 'Mei',
                                                    6 => 'Juni',
                                                    7 => 'Juli',
                                                    8 => 'Agustus',
                                                    9 => 'September',
                                                    10 => 'Oktober',
                                                    11 => 'November',
                                                    12 => 'Desember',
                                                ];
                                                $tanggal_sponsor = isset($sponsor->tanggal_sponsor)
                                                    ? date('d', strtotime($sponsor->tanggal_sponsor)) .
                                                        ' ' .
                                                        $bulanIndonesia[
                                                            date('n', strtotime($sponsor->tanggal_sponsor))
                                                        ] .
                                                        ' ' .
                                                        date('Y', strtotime($sponsor->tanggal_sponsor))
                                                    : 'Data tidak tersedia';
                                                echo $tanggal_sponsor;
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>No. Hp Sponsor</th>
                                        <td>{{ $sponsor->no_telepon_sponsor ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $sponsor->deskripsi ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Sponsor</th>
                                        <td>{{ isset($sponsor->jumlah_sponsor) ? 'Rp ' . number_format($sponsor->jumlah_sponsor) : 'Data tidak tersedia' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    </div>

                    <div class="col-md-4">
                        <div class="image-frame">
                            @if ($sponsor->foto_sponsor)
                                <img src="{{ asset($sponsor->foto_sponsor) }}" alt="Foto Sponsor"
                                    class="img-fluid rounded">
                            @else
                                <p>Tidak ada foto Sponsor.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
