<?php

namespace App\Services;

use App\Models\JadwalPembelajaran;
use Carbon\Carbon;

class JadwalPembelajaranService
{
    /**
     * Menghasilkan data kalender berdasarkan minggu pembelajaran aktif.
     *
     * @param array $weekDays Hari-hari dalam seminggu.
     * @param string $startOfWeek Tanggal mulai minggu pembelajaran.
     * @param string $endOfWeek Tanggal berakhir minggu pembelajaran.
     * @param int $lokasi_penugasan_id ID lokasi penugasan.
     * @return array Data kalender yang siap digunakan di view.
     */
    public function generateCalendarData($weekDays, $startOfWeek, $endOfWeek, $lokasi_penugasan_id)
    {
        $calendarData = [];
        $now = Carbon::now(); // Dapatkan waktu sekarang
        $today = Carbon::today(); // Dapatkan tanggal hari ini

        // Ambil semua jadwal pembelajaran yang relevan
        $jadwalPembelajaran = JadwalPembelajaran::with(['kelas', 'guru'])
            ->whereBetween('tanggal_pembelajaran', [$startOfWeek, $endOfWeek])
            ->where('lokasi_penugasan_id', $lokasi_penugasan_id)
            ->orderBy('jam_mulai')
            ->get();

        foreach ($jadwalPembelajaran as $jadwal) {
            $timeText = "{$jadwal->jam_mulai} - {$jadwal->jam_selesai}";

            if (!isset($calendarData[$timeText])) {
                $calendarData[$timeText] = array_fill_keys($weekDays, null);
            }

            $day = $jadwal->hari_pembelajaran;
            $scheduleDate = Carbon::parse($jadwal->tanggal_pembelajaran);
            $startTime = Carbon::parse($jadwal->jam_mulai);
            $endTime = Carbon::parse($jadwal->jam_selesai);

            // Logika warna berdasarkan waktu sekarang dan waktu jadwal
            if ($scheduleDate->isToday()) {
                // Jika waktu sekarang berada di antara jam mulai dan jam selesai
                if ($now->isBetween($startTime, $endTime, true)) {
                    $color = '#99cc99'; // Warna biru untuk waktu saat ini di dalam jadwal
                }
                // Jika waktu sekarang mendekati jadwal (kurang dari 30 menit ke waktu mulai)
                elseif ($now->diffInMinutes($startTime, false) > 0 && $now->diffInMinutes($startTime, false) <= 30) {
                    $color = '#ffff99'; // Kuning untuk waktu mendekati 30 menit ke depan
                }
                // Jika waktu sekarang sudah lewat dari jam selesai
                elseif ($now->isAfter($endTime)) {
                    $color = '#ff9999'; // Merah untuk jadwal yang sudah lewat
                }
                // Jadwal untuk waktu di masa depan
                else {
                    $color = '#ccffcc'; // Hijau untuk jadwal di masa depan
                }
            } elseif ($scheduleDate->isPast()) {
                $color = '#ffcccc'; // Merah untuk jadwal yang sudah lewat
            } else {
                $color = '#ccffcc'; // Hijau untuk jadwal di masa depan
            }

            // Pastikan hari valid dan cocok dengan weekDays
            if (in_array($day, $weekDays)) {
                $calendarData[$timeText][$day] = [
                    'kelas' => $jadwal->kelas ? $jadwal->kelas->nama_kelas : 'Kosong',
                    'guru' => $jadwal->guru ? $jadwal->guru->nama_lengkap : 'Kosong',
                    'hari' => $day,
                    'time_start' => $jadwal->jam_mulai,
                    'time_end' => $jadwal->jam_selesai,
                    'rowspan' => 1, // Sesuaikan jika perlu
                    'color' => $color, // Set warna yang sudah ditentukan
                ];
            }
        }

        return $calendarData;
    }

    public function generateJadwalData($weekDays, $startOfWeek, $endOfWeek)
    {
        $calendarData = [];
        $jadwalPembelajaran = JadwalPembelajaran::with(['kelas', 'guru'])
            ->whereBetween('tanggal_pembelajaran', [$startOfWeek, $endOfWeek])
            ->orderBy('tanggal_pembelajaran')
            ->get();

        foreach ($jadwalPembelajaran as $jadwal) {
            $timeRange = [
                ['start' => $jadwal->jam_mulai, 'end' => $jadwal->jam_selesai],
            ];

            foreach ($timeRange as $time) {
                $timeText = $time['start'] . ' - ' . $time['end'];
                $lokasiPenugasanId = $jadwal->lokasi_penugasan_id;

                if (!isset($calendarData[$lokasiPenugasanId])) {
                    $calendarData[$lokasiPenugasanId] = [];
                }

                if (!isset($calendarData[$lokasiPenugasanId][$timeText])) {
                    $calendarData[$lokasiPenugasanId][$timeText] = array_fill_keys($weekDays, null);
                }

                foreach ($weekDays as $day) {
                    if ($calendarData[$lokasiPenugasanId][$timeText][$day] === null) {
                        $jadwalHariIni = $jadwalPembelajaran
                            ->where('hari_pembelajaran', $day)
                            ->where('jam_mulai', $time['start'])
                            ->where('lokasi_penugasan_id', $lokasiPenugasanId)
                            ->first();

                        $rowData = [
                            'kelas' => 'Kosong',
                            'guru' => 'Kosong',
                            'hari' => $day,
                            'time_start' => '-',
                            'time_end' => '-',
                            'rowspan' => 1,
                            'color' => '#ffffff'
                        ];

                        if ($jadwalHariIni) {
                            $rowData = [
                                'kelas' => $jadwalHariIni->kelas ? $jadwalHariIni->kelas->nama_kelas : 'Kosong',
                                'guru' => $jadwalHariIni->guru ? $jadwalHariIni->guru->nama_lengkap : 'Kosong',
                                'hari' => $day,
                                'time_start' => $jadwalHariIni->jam_mulai,
                                'time_end' => $jadwalHariIni->jam_selesai,
                                'rowspan' => $jadwalHariIni->difference / 30 ?? 1,
                                'color' => '#f0f0f0'
                            ];
                        }

                        $calendarData[$lokasiPenugasanId][$timeText][$day] = $rowData;
                    }
                }
            }
        }

        return $calendarData;
    }
}
