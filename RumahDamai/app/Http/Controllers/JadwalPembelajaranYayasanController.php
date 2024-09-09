<?php

namespace App\Http\Controllers;

use App\Models\MingguPembelajaran;
use App\Services\JadwalPembelajaranService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class JadwalPembelajaranYayasanController extends Controller
{
    public function index(Request $request, JadwalPembelajaranService $jadwalPembelajaranService)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil lokasi_penugasan_id dari pengguna yang login
        $lokasi_penugasan_id = Auth::user()->lokasi_penugasan_id;

        // Mendapatkan hari-hari dalam seminggu
        $weekDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Mendapatkan tanggal hari ini
        $today = Carbon::today();

        // Mendapatkan minggu pembelajaran aktif berdasarkan tanggal sekarang dan lokasi_penugasan_id guru yang login
        $activeWeek = MingguPembelajaran::where('tanggal_mulai', '<=', $today)
            ->where('tanggal_berakhir', '>=', $today)
            ->where('lokasi_penugasan_id', $lokasi_penugasan_id)
            ->first();

        if (!$activeWeek) {
            // Jika tidak ada minggu pembelajaran aktif untuk lokasi_penugasan_id guru yang login, tampilkan pesan atau lakukan tindakan lain
            $errorMessage = 'Tidak ada jadwal pembelajaran aktif untuk lokasi penugasan Anda.';
            return view('guru.JadwalPembelajaranYayasan.index', compact('weekDays', 'errorMessage'));
        }

        // Mendapatkan tanggal mulai dan tanggal berakhir minggu pembelajaran aktif
        $startOfWeek = $activeWeek->tanggal_mulai;
        $endOfWeek = $activeWeek->tanggal_berakhir;

        // Menghasilkan data kalender sesuai dengan minggu pembelajaran aktif
        $calendarData = $jadwalPembelajaranService->generateCalendarData($weekDays, $startOfWeek, $endOfWeek, $lokasi_penugasan_id);

        return view('guru.JadwalPembelajaranYayasan.index', compact('weekDays', 'calendarData'));
    }

    // public function index(Request $request, JadwalPembelajaranService $jadwalPembelajaranService)
    // {
    //     // Ambil ID pengguna yang sedang login
    //     $userId = Auth::id();

    //     // Ambil role pengguna yang login
    //     $userRole = Auth::user()->role;

    //     // Mendapatkan hari-hari dalam seminggu
    //     $weekDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    //     // Mendapatkan tanggal hari ini
    //     $today = Carbon::today();

    //     // Inisialisasi default untuk $calendarData
    //     $calendarData = [];

    //     if ($userRole === 'admin') {
    //         // Mendapatkan minggu pembelajaran aktif untuk semua lokasi
    //         $activeWeek = MingguPembelajaran::where('tanggal_mulai', '<=', $today)
    //             ->where('tanggal_berakhir', '>=', $today)
    //             ->get();
    //     } else {
    //         // Mendapatkan lokasi_penugasan_id dari pengguna yang login
    //         $lokasi_penugasan_id = Auth::user()->lokasi_penugasan_id;

    //         // Mendapatkan minggu pembelajaran aktif berdasarkan lokasi_penugasan_id
    //         $activeWeek = MingguPembelajaran::where('tanggal_mulai', '<=', $today)
    //             ->where('tanggal_berakhir', '>=', $today)
    //             ->where('lokasi_penugasan_id', $lokasi_penugasan_id)
    //             ->get();
    //     }

    //     if ($activeWeek->isEmpty()) {
    //         // Jika tidak ada minggu pembelajaran aktif, tampilkan pesan atau lakukan tindakan lain
    //         $errorMessage = 'Tidak ada jadwal pembelajaran aktif.';
    //         return view('guru.JadwalPembelajaranYayasan.index', compact('weekDays', 'calendarData', 'errorMessage'));
    //     }

    //     // Menghasilkan data kalender sesuai dengan minggu pembelajaran aktif
    //     foreach ($activeWeek as $week) {
    //         $startOfWeek = $week->tanggal_mulai;
    //         $endOfWeek = $week->tanggal_berakhir;

    //         // Generate calendar data untuk minggu pembelajaran aktif
    //         $calendarData[] = $jadwalPembelajaranService->generateCalendarData($weekDays, $startOfWeek, $endOfWeek, $week->lokasi_penugasan_id);
    //     }

    //     // Jika admin, gabungkan semua data lokasi ke dalam satu kalender
    //     if ($userRole === 'admin') {
    //         $calendarData = array_merge(...$calendarData);
    //     }

    //     return view('guru.JadwalPembelajaranYayasan.index', compact('weekDays', 'calendarData'));
    // }
}
