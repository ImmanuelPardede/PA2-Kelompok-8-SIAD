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

        // Ambil semua jadwal pembelajaran yang sesuai dengan tanggal dan lokasi penugasan
        $jadwalPembelajaran = JadwalPembelajaran::with(['kelas', 'guru'])
            ->whereBetween('tanggal_pembelajaran', [$startOfWeek, $endOfWeek])
            ->where('lokasi_penugasan_id', $lokasi_penugasan_id)
            ->orderBy('jam_mulai')
            ->get();

        // Inisialisasi calendarData dengan semua slot waktu dan hari sebagai null
        foreach ($jadwalPembelajaran as $jadwal) {
            $timeText = "{$jadwal->jam_mulai} - {$jadwal->jam_selesai}";

            if (!isset($calendarData[$timeText])) {
                $calendarData[$timeText] = array_fill_keys($weekDays, null);
            }

            $day = $jadwal->hari_pembelajaran;

            // Pastikan hari valid dan sesuai dengan weekDays
            if (in_array($day, $weekDays)) {
                $calendarData[$timeText][$day] = [
                    'kelas' => $jadwal->kelas ? $jadwal->kelas->nama_kelas : 'Kosong',
                    'guru' => $jadwal->guru ? $jadwal->guru->nama_lengkap : 'Kosong',
                    'hari' => $day,
                    'time_start' => $jadwal->jam_mulai,
                    'time_end' => $jadwal->jam_selesai,
                    'rowspan' => 1, // Jika diperlukan, sesuaikan logika rowspan
                    'color' => '#f0f0f0' // Atur warna sesuai kebutuhan
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
