@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Daftar Jadwal Pembelajaran</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Kelas</th>
                                <th>Guru</th>
                                <th>Tanggal Pembelajaran</th>
                                <th>Hari Pembelajaran</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($jadwalPembelajaran->isNotEmpty())
                                @foreach ($jadwalPembelajaran as $jadwal)
                                    <tr>
                                        <td>{{ $jadwal->kelas ? $jadwal->kelas->nama_kelas : '' }}</td>
                                        <td>{{ $jadwal->guru ? $jadwal->guru->nama_lengkap : '' }}</td>
                                        <td>{{ $jadwal->tanggal_pembelajaran ? \Carbon\Carbon::parse($jadwal->tanggal_pembelajaran)->format('d/m/Y') : '' }}
                                        </td>
                                        <td>{{ $jadwal->hari_pembelajaran ?? '' }}</td>
                                        <td>{{ $jadwal->jam_mulai ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '' }}
                                        </td>
                                        <td>{{ $jadwal->jam_selesai ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('jadwalPembelajaran.edit', $jadwal->id) }}"
                                                class="btn btn-warning">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data jadwal pembelajaran tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
