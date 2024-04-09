<?php

namespace App\Http\Controllers;

use App\Services\JadwalPembelajaranService;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    public function index(Request $request, JadwalPembelajaranService $jadwalPembelajaranService)
    {
        $weekDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $calendarData = $jadwalPembelajaranService->generateCalendarData($weekDays);

        return view('guru.kalender.index', compact('weekDays', 'calendarData'));
    }
}
