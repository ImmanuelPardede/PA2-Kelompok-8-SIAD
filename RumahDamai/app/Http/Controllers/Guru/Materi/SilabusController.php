<?php

namespace App\Http\Controllers\Guru\Materi;

use App\Models\Kelas;
use App\Models\Silabus;
use App\Models\TahunKurikulum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SilabusController extends Controller
{
    public function index()
    {
        $silabusList = Silabus::orderBy('created_at', 'desc')->paginate(7);
        return view('guru.materi.silabus.index', compact('silabusList'));
    }

    public function create()
    {
        $tahunKurikulum = TahunKurikulum::all();
        $kelas = Kelas::all();
        $loggedInUserId = Auth::id();

        // Ambil data user yang sedang login (yang membuat silabus) dan memiliki role "guru"
        $users = User::where('role', 'guru')->where('id', $loggedInUserId)->get();

        if (request()->has('kelas_id')) {
            $selectedKelasId = request()->input('kelas_id');
            $selectedKelas = Kelas::find($selectedKelasId);

            if ($selectedKelas) {
                $tahun_kurikulum_id = $selectedKelas->tahun_kurikulum_id;
            }
        }

        return view('guru.materi.silabus.create', compact('kelas', 'tahunKurikulum', 'users'));
    }

    public function store(Request $request)
    {
        $loggedInUserId = Auth::id();

        // Validate the request input
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_kurikulum_id' => 'required|exists:tahun_kurikulum,id',
            'deskripsi' => 'nullable|string',
            'hasil_kursus' => 'nullable|string',
            'tipe_pembelajaran' => 'nullable|string',
            'penilaian' => 'nullable|string',
            'konten_kursus' => 'nullable|string',
            'buku_pegangan_dan_referensi' => 'nullable|string',
            'alat' => 'nullable|string',
        ]);

        // Check if a silabus already exists for the given class and curriculum year
        $existingSilabus = Silabus::where('kelas_id', $request->kelas_id)
            ->where('tahun_kurikulum_id', $request->tahun_kurikulum_id)
            ->first();

        if ($existingSilabus) {
            return redirect()->back()->withErrors(['kelas_id' => 'Silabus untuk kelas dan tahun kurikulum yang dipilih sudah ada.']);
        }

        // Prepare the input data
        $input = $request->all();
        $input['tanggal_publish'] = now();
        $input['user_id'] = $loggedInUserId;

        // Create the new silabus
        Silabus::create($input);

        return redirect()->route('silabus.index')->with('success', 'Silabus berhasil ditambahkan.');
    }



    public function show(string $id)
    {
        $silabus = Silabus::with('kelas')->find($id);
        return view('guru.materi.silabus.show', compact('silabus'));
    }

    public function edit(string $id)
    {
        $silabus = Silabus::findOrFail($id);
        $kelas = Kelas::all();
        $tahunKurikulum = TahunKurikulum::all();
        $loggedInUserId = Auth::id();

        return view('guru.materi.silabus.edit', compact('silabus', 'kelas', 'tahunKurikulum'));
    }

    public function update(Request $request, string $id)
    {
        $silabus = Silabus::findOrFail($id);

        // Validate the request input
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_kurikulum_id' => 'required|exists:tahun_kurikulum,id',
            'deskripsi' => 'nullable|string',
            'hasil_kursus' => 'nullable|string',
            'tipe_pembelajaran' => 'nullable|string',
            'penilaian' => 'nullable|string',
            'konten_kursus' => 'nullable|string',
            'buku_pegangan_dan_referensi' => 'nullable|string',
            'alat' => 'nullable|string',
        ]);

        // Check if a silabus already exists for the given class and curriculum year, excluding the current silabus
        $existingSilabus = Silabus::where('kelas_id', $request->kelas_id)
            ->where('tahun_kurikulum_id', $request->tahun_kurikulum_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingSilabus) {
            return redirect()->back()->withErrors(['kelas_id' => 'Silabus untuk kelas dan tahun kurikulum yang dipilih sudah ada.']);
        }

        // Update the silabus with the new input data
        $input = $request->all();
        $silabus->update($input);

        return redirect()->route('silabus.index')->with('success', 'Silabus berhasil diperbarui.');
    }



    public function destroy(string $id)
    {
        $silabus = Silabus::find($id);
        $silabus->delete();

        return redirect()->route('silabus.index')->with('success', 'Silabus berhasil dihapus.');
    }
}
