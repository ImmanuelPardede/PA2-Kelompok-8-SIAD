@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Jadwal Pembelajaran</h2>
                <form action="{{ route('jadwalPembelajaran.update', $jadwalPembelajaran->id) }}" method="POST">
                    @csrf
                    @if (isset($jadwalPembelajaran))
                        @method('PUT')
                        <input type="hidden" name="jadwal_pembelajaran_id" value="{{ $jadwalPembelajaran->id }}">
                    @endif
                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-control">
                            @foreach ($daftarKelas as $kelas)
                                <option value="{{ $kelas->id }}"
                                    {{ old('kelas_id', $jadwalPembelajaran->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minggu_pembelajaran_id">Minggu Pembelajaran</label>
                        <select name="minggu_pembelajaran_id" id="minggu_pembelajaran_id" class="form-control">
                            @foreach ($daftarMingguPembelajaran as $mingguPembelajaran)
                                <option value="{{ $mingguPembelajaran->id }}"
                                    {{ old('minggu_pembelajaran_id', $jadwalPembelajaran->minggu_pembelajaran_id) == $mingguPembelajaran->id ? 'selected' : '' }}>
                                    {{ $mingguPembelajaran->minggu_pembelajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="modul_materi_id">Modul Materi</label>
                        <select name="modul_materi_id" id="modul_materi_id" class="form-control">
                            @foreach ($daftarModulMateri as $modulMateri)
                                <option value="{{ $modulMateri->id }}"
                                    {{ $jadwalPembelajaran->modul_materi_id == $modulMateri->id ? 'selected' : '' }}>
                                    {{ $modulMateri->nama_materi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="guru_id">Nama Guru</label>
                        <select name="guru_id" id="guru_id" class="form-control">
                            @foreach ($daftarGuru as $guru)
                                <option value="{{ $guru->id }}"
                                    {{ $jadwalPembelajaran->guru_id == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_pembelajaran">Tanggal Pembelajaran</label>
                        <input type="date" name="tanggal_pembelajaran" id="tanggal_pembelajaran" class="form-control"
                            value="{{ $jadwalPembelajaran->tanggal_pembelajaran }}">
                    </div>
                    <div class="form-group">
                        <label for="hari_pembelajaran">Hari Pembelajaran</label>
                        <input type="text" name="hari_pembelajaran" id="hari_pembelajaran" class="form-control"
                            value="{{ $jadwalPembelajaran->hari_pembelajaran }}">
                    </div>
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                            value="{{ $jadwalPembelajaran->jam_mulai }}">
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                            value="{{ $jadwalPembelajaran->jam_selesai }}">
                    </div>
                    <button type="submit"
                        class="btn btn-primary">{{ isset($jadwalPembelajaran) ? 'Simpan Perubahan' : 'Tambahkan' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
