<?php

namespace App\Http\Controllers;

use App\Models\MingguPembelajaran;
use App\Services\JadwalPembelajaranService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JadwalPembelajaranYayasanController extends Controller
{
    /**
     * Menampilkan daftar jadwal pembelajaran.
     *
     * @param Request $request
     * @param JadwalPembelajaranService $jadwalPembelajaranService
     * @return \Illuminate\View\View
     */
    public function index(Request $request, JadwalPembelajaranService $jadwalPembelajaranService)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
        $userId = $user->id;
        $lokasi_penugasan_id = $user->lokasi_penugasan_id;

        // Mendapatkan hari-hari dalam seminggu
        $weekDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Mendapatkan tanggal hari ini
        $today = Carbon::today();

        // Mendapatkan minggu pembelajaran aktif berdasarkan tanggal sekarang dan lokasi_penugasan_id pengguna yang login
        $activeWeek = MingguPembelajaran::where('tanggal_mulai', '<=', $today)
            ->where('tanggal_berakhir', '>=', $today)
            ->where('lokasi_penugasan_id', $lokasi_penugasan_id)
            ->first();

        if (!$activeWeek) {
            // Jika tidak ada minggu pembelajaran aktif, tampilkan pesan error
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
}
