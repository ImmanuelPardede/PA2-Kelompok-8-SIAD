@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Atur Jadwal Pembelajaran</h2>
                <form
                    action="{{ isset($jadwalPembelajaran) ? route('jadwalPembelajaran.update', $jadwalPembelajaran->id) : route('jadwalPembelajaran.store') }}"
                    method="POST">
                    @csrf
                    @isset($jadwalPembelajaran)
                        @method('PUT')
                        <input type="hidden" name="jadwal_pembelajaran_id" value="{{ $jadwalPembelajaran->id }}">
                    @endisset

                    <!-- Kelas (Tidak Dapat Diedit) -->
                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-control" disabled>
                            @foreach ($daftarKelas as $kelas)
                                <option value="{{ $kelas->id }}"
                                    {{ old('kelas_id', $jadwalPembelajaran->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Hidden input untuk mengirim nilai kelas_id -->
                        <input type="hidden" name="kelas_id" value="{{ $jadwalPembelajaran->kelas_id ?? '' }}">
                    </div>

                    <!-- Minggu Pembelajaran (Tidak Dapat Diedit) -->
                    <div class="form-group">
                        <label for="minggu_pembelajaran_id">Minggu Pembelajaran</label>
                        <select name="minggu_pembelajaran_id" id="minggu_pembelajaran_id" class="form-control" disabled>
                            @foreach ($daftarMingguPembelajaran as $mingguPembelajaran)
                                <option value="{{ $mingguPembelajaran->id }}"
                                    {{ old('minggu_pembelajaran_id', $jadwalPembelajaran->minggu_pembelajaran_id ?? '') == $mingguPembelajaran->id ? 'selected' : '' }}>
                                    {{ $mingguPembelajaran->minggu_pembelajaran }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Hidden input untuk mengirim nilai minggu_pembelajaran_id -->
                        <input type="hidden" name="minggu_pembelajaran_id"
                            value="{{ $jadwalPembelajaran->minggu_pembelajaran_id ?? '' }}">
                    </div>

                    <!-- Modul Materi (Tidak Dapat Diedit) -->
                    <div class="form-group">
                        <label for="modul_materi_id">Modul Materi</label>
                        <select name="modul_materi_id" id="modul_materi_id" class="form-control" disabled>
                            @foreach ($daftarModulMateri as $modulMateri)
                                <option value="{{ $modulMateri->id }}"
                                    {{ isset($jadwalPembelajaran) && $jadwalPembelajaran->modul_materi_id == $modulMateri->id ? 'selected' : '' }}>
                                    {{ $modulMateri->nama_materi }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Hidden input untuk mengirim nilai modul_materi_id -->
                        <input type="hidden" name="modul_materi_id"
                            value="{{ $jadwalPembelajaran->modul_materi_id ?? '' }}">
                    </div>

                    <!-- Nama Guru (Tidak Dapat Diedit) -->
                    <div class="form-group">
                        <label for="user_id">Nama Guru</label>
                        <select name="user_id" id="user_id" class="form-control" disabled>
                            @foreach ($daftarGuru as $guru)
                                <option value="{{ $guru->id }}"
                                    {{ isset($jadwalPembelajaran) && $jadwalPembelajaran->guru_id == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Hidden input untuk mengirim nilai user_id -->
                        <input type="hidden" name="user_id" value="{{ $jadwalPembelajaran->guru_id ?? '' }}">
                    </div>

                    <!-- Lokasi Penugasan (Tidak Dapat Diedit) -->
                    <div class="form-group">
                        <label for="lokasi_penugasan_id">Lokasi Penugasan</label>
                        <select name="lokasi_penugasan_id" id="lokasi_penugasan_id" class="form-control" disabled>
                            @foreach ($lokasiPenugasan as $lokasi)
                                <option value="{{ $lokasi->id }}"
                                    {{ isset($jadwalPembelajaran) && $jadwalPembelajaran->lokasi_penugasan_id == $lokasi->id ? 'selected' : '' }}>
                                    {{ $lokasi->lokasi }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Hidden input untuk mengirim nilai lokasi_penugasan_id -->
                        <input type="hidden" name="lokasi_penugasan_id"
                            value="{{ $jadwalPembelajaran->lokasi_penugasan_id ?? '' }}">
                    </div>

                    @isset($jadwalPembelajaran)
                        @php
                            $start = \Carbon\Carbon::parse($jadwalPembelajaran->mingguPembelajaran->tanggal_mulai);
                            $end = \Carbon\Carbon::parse($jadwalPembelajaran->mingguPembelajaran->tanggal_berakhir);
                        @endphp
                        <div class="form-group">
                            <label for="tanggal_pembelajaran">Tanggal Pembelajaran Minggu
                                {{ $jadwalPembelajaran->minggu_pembelajaran_id }} ({{ $start->format('d/m/Y') }} -
                                {{ $end->format('d/m/Y') }})</label>
                            <input type="date" name="tanggal_pembelajaran" id="tanggal_pembelajaran" class="form-control"
                                value="{{ old('tanggal_pembelajaran', $jadwalPembelajaran->tanggal_pembelajaran ? $jadwalPembelajaran->tanggal_pembelajaran->format('Y-m-d') : '') }}"
                                min="{{ $start->format('Y-m-d') }}" max="{{ $end->format('Y-m-d') }}"
                                onchange="updateHariPembelajaran(this.value)">
                        </div>
                    @endisset

                    <div class="form-group">
                        <label for="hari_pembelajaran">Hari Pembelajaran</label>
                        <input type="text" name="hari_pembelajaran" id="hari_pembelajaran" class="form-control"
                            value="{{ isset($jadwalPembelajaran) ? $jadwalPembelajaran->hari_pembelajaran : '' }}"
                            readonly>
                    </div>

                    <script>
                        function updateHariPembelajaran(tanggalPembelajaran) {
                            if (!tanggalPembelajaran) {
                                document.getElementById('hari_pembelajaran').value = '';
                                return;
                            }
                            var date = new Date(tanggalPembelajaran);
                            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            var hariPembelajaran = days[date.getDay()];
                            document.getElementById('hari_pembelajaran').value = hariPembelajaran;
                        }

                        // Panggil fungsi updateHariPembelajaran saat halaman dimuat untuk pertama kali
                        document.addEventListener('DOMContentLoaded', function() {
                            var tanggalPembelajaran = document.getElementById('tanggal_pembelajaran').value;
                            if (tanggalPembelajaran) {
                                updateHariPembelajaran(tanggalPembelajaran);
                            }
                        });
                    </script>

                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                            value="{{ old('jam_mulai', $jadwalPembelajaran->jam_mulai ? \Carbon\Carbon::parse($jadwalPembelajaran->jam_mulai)->format('H:i') : '') }}">
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                            value="{{ old('jam_selesai', $jadwalPembelajaran->jam_selesai ? \Carbon\Carbon::parse($jadwalPembelajaran->jam_selesai)->format('H:i') : '') }}">
                    </div>
                    <button type="submit"
                        class="btn btn-primary">{{ isset($jadwalPembelajaran) ? 'Simpan Perubahan' : 'Tambahkan' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
