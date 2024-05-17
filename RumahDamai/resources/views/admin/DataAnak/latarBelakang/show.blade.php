@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Latar Belakang Anak</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Nama Anak</th>
                                        <td>{{ $latarBelakang->anak->nama_lengkap ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usia</th>
                                        <td>{{ $latarBelakang->usia ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>{{ $latarBelakang->kelas ?? 'Data tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ isset($latarBelakang->tanggal) ? \Carbon\Carbon::parse($latarBelakang->tanggal)->format('d/m/Y') : 'Data tidak tersedia' }}</td>
                                    </tr>
                                    @if($latarBelakang->gambarLatarBelakang->count() > 0)
                                        @foreach($latarBelakang->gambarLatarBelakang as $index => $gambar)
                                            <tr>
                                                <th>Gambar</th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="image-container" style="width: 200px; height: 200px; overflow: hidden; border-radius: 5px; margin-bottom: 20px;">
                                                            <div class="image-frame" style="width: 100%; height: 100%; object-fit: cover;">
                                                                <img src="{{ asset('uploads/gambar_latar_belakang/' . $gambar->nama) }}" alt="Gambar Latar Belakang" style="width: 100%; height: auto; object-fit: cover; border-radius: 5px;">
                                                            </div>
                                                        </div>
                                                        @if($latarBelakang->deskripsi)
                                                            @php
                                                                $deskripsiArray = json_decode($latarBelakang->deskripsi, true);
                                                                $deskripsiSatuNilai = $deskripsiArray[$index] ?? ''; // Ambil nilai sesuai indeks gambar
                                                            @endphp
                                                            <p class="ml-3"><strong>Deskripsi:</strong> {{ $deskripsiSatuNilai }}</p>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">Tidak ada gambar dan deskripsi.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
