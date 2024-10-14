<?php

namespace App\Http\Controllers\Guru\JadwalPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\LokasiTugas;
use App\Models\MingguPembelajaran;
use App\Models\ModulMateri;
use App\Models\JadwalPembelajaran;
use App\Models\TahunAjaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class JadwalPembelajaranController extends Controller
{
    public function tambahJadwalPembelajaran(Request $request, ModulMateri $modulMateri)
    {
        $existingJadwal = JadwalPembelajaran::where('modul_materi_id', $modulMateri->id)->first();

        if ($existingJadwal) {
            // Jika jadwal sudah ada, tampilkan form edit
            return $this->edit($existingJadwal->id);
        } else {
            // Jika tidak, tambahkan jadwal baru
            $jadwalPembelajaran = new JadwalPembelajaran();
            $jadwalPembelajaran->kelas_id = $modulMateri->kelas_id;
            $jadwalPembelajaran->minggu_pembelajaran_id = $modulMateri->minggu_pembelajaran_id;
            $jadwalPembelajaran->modul_materi_id = $modulMateri->id;
            $jadwalPembelajaran->user_id = Auth::id();
            $jadwalPembelajaran->lokasi_penugasan_id = Auth::user()->lokasi_penugasan_id; // Perbaikan disini
            $jadwalPembelajaran->save();

            return redirect()->route('guru.JadwalPembelajaran.index')->with('success', 'Jadwal pembelajaran berhasil ditambahkan.');
        }
    }

    public function index(Request $request)
{
    // Ambil ID pengguna yang sedang login
    $userId = Auth::id();

    // Ambil lokasi penugasan dari pengguna yang login
    $user = Auth::user();
    $lokasiPenugasanId = $user->lokasi_penugasan_id; // Asumsi field ini ada di model User

    // Ambil tahun ajaran yang sesuai dengan tahun sekarang
    $currentYear = date('Y');
    $tahunAjaranId = null; // Inisialisasi dengan null

    // Asumsi Anda memiliki model bernama 'TahunAjaran' untuk mengambil tahun ajaran saat ini
    $tahunAjaran = TahunAjaran::where('tahun_ajaran', $currentYear)->first();
    if ($tahunAjaran) {
        $tahunAjaranId = $tahunAjaran->id; // Dapatkan ID tahun ajaran saat ini
    }

    // Ambil minggu pembelajaran berdasarkan input dari request atau gunakan default minggu pertama jika tidak ada input
    $mingguPembelajaranId = $request->input('minggu_pembelajaran_id') ?: null;

    // Ambil jadwal pembelajaran sesuai filter yang dipilih
    $jadwalPembelajaran = JadwalPembelajaran::with(['modulMateri', 'modulMateri.mingguPembelajaran'])
        ->where('user_id', $userId)
        ->when($mingguPembelajaranId, function ($query, $mingguPembelajaranId) {
            return $query->where('minggu_pembelajaran_id', $mingguPembelajaranId);
        })
        ->whereHas('modulMateri', function ($query) use ($tahunAjaranId) {
            return $query->where('tahun_ajaran_id', $tahunAjaranId);
        })
        ->orderBy('created_at', 'asc')
        ->paginate(7)
        ->appends([
            'minggu_pembelajaran_id' => $mingguPembelajaranId, // Tambahkan parameter untuk pagination
        ]);

    // Ambil data minggu pembelajaran berdasarkan lokasi penugasan pengguna yang login untuk dropdown
    $mingguPembelajaranList = MingguPembelajaran::where('lokasi_penugasan_id', $lokasiPenugasanId)
        ->orderBy(DB::raw('CAST(minggu_pembelajaran AS UNSIGNED)'), 'asc') // Urutkan sebagai angka
        ->get();

    return view('guru.JadwalPembelajaran.index', compact('jadwalPembelajaran', 'mingguPembelajaranList'));
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kelas_id' => 'nullable',
            'minggu_pembelajaran_id' => 'nullable',
            'modul_materi_id' => 'nullable',
            'user_id' => 'nullable',
            'lokasi_penugasan_id' => 'nullable',
            'tanggal_pembelajaran' => 'nullable|date',
            'hari_pembelajaran' => 'nullable|string',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
        ]);

        JadwalPembelajaran::create($validatedData);

        return redirect()->route('jadwalPembelajaran.index')->with('success', 'Jadwal Pembelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwalPembelajaran = JadwalPembelajaran::findOrFail($id);
        $daftarMingguPembelajaran = MingguPembelajaran::all();
        $daftarKelas = Kelas::all();
        $daftarModulMateri = ModulMateri::all();
        $daftarGuru = User::all();
        $lokasiPenugasan = LokasiTugas::all();

        return view('guru.JadwalPembelajaran.edit', compact('jadwalPembelajaran', 'daftarKelas', 'daftarMingguPembelajaran', 'daftarModulMateri', 'daftarGuru', 'lokasiPenugasan'));
    }


    public function update(Request $request, $id)
    {
        try {
            $jadwalPembelajaran = JadwalPembelajaran::findOrFail($id);

            Log::info('Request Data:', $request->all());

            $validatedData = $request->validate([
                'tanggal_pembelajaran' => 'required|date',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            ]);

            // Update hari_pembelajaran berdasarkan tanggal_pembelajaran
            $tanggal = Carbon::createFromFormat('Y-m-d', $validatedData['tanggal_pembelajaran']);
            $validatedData['hari_pembelajaran'] = $tanggal->translatedFormat('l'); // Atau 'd/m/Y' sesuai kebutuhan

            Log::info('Validated Data:', $validatedData);

            Log::info('Before Update:', $jadwalPembelajaran->toArray());

            $jadwalPembelajaran->update($validatedData);

            Log::info('After Update:', $jadwalPembelajaran->toArray());

            return redirect()->route('jadwalPembelajaran.index')->with('success', 'Jadwal Pembelajaran berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Update Error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Jadwal Pembelajaran. Silakan coba lagi.');
        }
    }
}
