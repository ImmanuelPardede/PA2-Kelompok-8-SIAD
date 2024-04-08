<?php

namespace App\Http\Controllers\Guru\JadwalPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\ModulMateri;
use App\Models\JadwalPembelajaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JadwalPembelajaranController extends Controller
{
    public function tambahJadwalPembelajaran(ModulMateri $modulMateri)
    {
        $jadwalPembelajaran = new JadwalPembelajaran();
        $jadwalPembelajaran->kelas_id = $modulMateri->kelas_id;
        $jadwalPembelajaran->minggu_pembelajaran_id = $modulMateri->minggu_pembelajaran_id;
        $jadwalPembelajaran->modul_materi_id = $modulMateri->id;
        $jadwalPembelajaran->user_id = Auth::id();
        $jadwalPembelajaran->tanggal = Carbon::now()->toDateString();
        $jadwalPembelajaran->jam_mulai = '08:00:00';
        $jadwalPembelajaran->jam_selesai = '10:00:00';
        $jadwalPembelajaran->save();

        return redirect()->route('guru.JadwalPembelajaran.index')->with('success', 'Jadwal pembelajaran berhasil ditambahkan.');
    }

    public function index()
    {
        $jadwalPembelajaran = JadwalPembelajaran::with(['modulMateri', 'modulMateri.mingguPembelajaran'])
            ->orderBy('created_at', 'asc')
            ->paginate(7);

        return view('guru.JadwalPembelajaran.index', compact('jadwalPembelajaran'));
    }
}
