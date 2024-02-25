<!-- resources/views/adminHome.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>
                    <div class="card-body">
                            <!-- Bagian kiri - Jadwal Kelas -->


                        <div class="mt-4">
                            <h1 id="current-day">{{ now()->format('l, j F Y') }}.</h1>
                            <h1 id="current-time">{{ now()->format('H:i:s') }}</h1>
                        </div>
                    </div>
                    <div class="row">

                    <div class="col-md-6">
                        <h2>Jadwal Kelas</h2>
                        <ul>
                            <li>Kelas: XII IPA 1, Mata Pelajaran: Matematika, Jam: 08:00 - 09:30</li>
                            <li>Kelas: XII IPS 2, Mata Pelajaran: Bahasa Indonesia, Jam: 10:00 - 11:30</li>
                            <!-- Tambahkan data jadwal kelas lainnya sesuai kebutuhan -->
                        </ul>
                    </div>

                    <!-- Bagian kanan - Pengumuman -->
                    <div class="col-md-6">
                        <h2>Pengumuman</h2>
                        <ul>
                            <li><strong>Penting: Perubahan Jadwal Ujian</strong>: Mohon diperhatikan bahwa jadwal ujian telah berubah.</li>
                            <li><strong>Pengumuman Penting</strong>: Semua siswa diharapkan mengikuti rapat pada tanggal 15 Februari.</li>
                            <!-- Tambahkan pengumuman lainnya sesuai kebutuhan -->
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const dayElement = document.getElementById('current-day');
            const timeElement = document.getElementById('current-time');

            const now = new Date();
            const formattedDay = now.toLocaleDateString('ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
            const formattedTime = now.toLocaleTimeString();

            dayElement.innerText = `Saat ini adalah ${formattedDay}.`;
            timeElement.innerText = `Waktu sekarang: ${formattedTime}`;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);

        // Initial update
        updateClock();
    </script>
    
@endsection
