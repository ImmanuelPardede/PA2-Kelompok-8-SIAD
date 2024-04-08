@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Daftar Jadwal Pembelajaran</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Kelas</th>
                            <th>Minggu Pembelajaran</th>
                            <th>Materi Pembelajaran</th>
                            <th>Guru</th>
                            <th>Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwalPembelajaran as $jadwal)
                        <tr>
                            <td>{{ $jadwal->kelas->nama_kelas }}</td>
                            <td>{{ $jadwal->mingguPembelajaran->minggu_pembelajaran }}</td>
                            <td>{{ $jadwal->modulMateri->nama_materi }}</td>
                            <td>{{ $jadwal->guru->nama_lengkap }}</td>
                            <td>{{ $jadwal->tanggal }}</td>
                            <td>{{ $jadwal->jam_mulai }}</td>
                            <td>{{ $jadwal->jam_selesai }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
