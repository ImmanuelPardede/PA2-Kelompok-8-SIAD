@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h1 class="card-title head-data">Daftar Jadwal Pembelajaran</h1>
                </div>

                <hr>

                <div class="d-flex justify-content-end align-items-center mb-3">
                    <form action="{{ route('jadwalPembelajaran.index') }}" method="GET">
                        <div class="form-group mb-0">
                            <!-- Dropdown Minggu Pembelajaran -->
                            <select class="form-control js-example-basic-single custom-selectDropdown"
                                    name="minggu_pembelajaran_id"
                                    id="minggu_pembelajaran_id"
                                    onchange="this.form.submit()">
                                <option value="" disabled selected>-- Pilih Minggu Pembelajaran --</option>
                                @foreach ($mingguPembelajaranList as $mingguPembelajaran)
                                    <option value="{{ $mingguPembelajaran->id }}"
                                        {{ request('minggu_pembelajaran_id') == $mingguPembelajaran->id ? 'selected' : '' }}>
                                        {{ $mingguPembelajaran->minggu_pembelajaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Kelas</th>
                                <th>Guru</th>
                                <th>Minggu Pembelajaran</th>
                                <th>Tanggal Pembelajaran</th>
                                <th>Hari Pembelajaran</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwalPembelajaran as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ explode(' ', $jadwal->guru->nama_lengkap)[0] ?? '-' }}</td>
                                    <td>{{ $jadwal->mingguPembelajaran->minggu_pembelajaran ?? '-' }}</td>
                                    <td>{{ optional($jadwal->tanggal_pembelajaran)->format('d/m/Y') ?? '-' }}</td>
                                    <td>{{ $jadwal->hari_pembelajaran ?? '-' }}</td>
                                    <td>{{ optional($jadwal->jam_mulai)->format('H:i') ?? '-' }}</td>
                                    <td>{{ optional($jadwal->jam_selesai)->format('H:i') ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('jadwalPembelajaran.edit', $jadwal->id) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data jadwal pembelajaran tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                {{ $jadwalPembelajaran->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
