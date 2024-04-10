<?php

namespace App\Http\Controllers;

use App\Models\MingguPembelajaran;
use App\Services\JadwalPembelajaranService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KalenderController extends Controller
{
    public function index(Request $request, JadwalPembelajaranService $jadwalPembelajaranService)
    {
        // Mendapatkan hari-hari dalam seminggu
        $weekDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Mendapatkan tanggal hari ini
        $today = Carbon::today();

        // Mendapatkan minggu pembelajaran aktif berdasarkan tanggal sekarang
        $activeWeek = MingguPembelajaran::where('tanggal_mulai', '<=', $today)
            ->where('tanggal_berakhir', '>=', $today)
            ->first();

        if (!$activeWeek) {
            // Jika tidak ada minggu pembelajaran aktif, ambil minggu pembelajaran terdekat berdasarkan tanggal sekarang
            $activeWeek = MingguPembelajaran::where('tanggal_mulai', '>', $today)
                ->orderBy('tanggal_mulai', 'asc')
                ->first();
        }

        // Mendapatkan tanggal mulai dan tanggal berakhir minggu pembelajaran aktif
        $startOfWeek = $activeWeek->tanggal_mulai;
        $endOfWeek = $activeWeek->tanggal_berakhir;

        // Menghasilkan data kalender sesuai dengan minggu pembelajaran aktif
        $calendarData = $jadwalPembelajaranService->generateCalendarData($weekDays, $startOfWeek, $endOfWeek);

        return view('guru.kalender.index', compact('weekDays', 'calendarData'));
    }
}
