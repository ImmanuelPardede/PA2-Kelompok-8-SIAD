<?php

namespace App\Http\Controllers\Guru\Materi;

use App\Models\Kelas;
use App\Models\Silabus;
use App\Models\TahunAjaran;
use App\Models\TahunKurikulum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SilabusController extends Controller
{
    public function index(Request $request)
    {
        $guruId = Auth::id();
        $currentYear = now()->year;
        $tahunAjaran = TahunAjaran::where('tahun_ajaran', $currentYear)->first();
        $tahunAjaranId = $request->input('tahun_ajaran_id') ?: ($tahunAjaran ? $tahunAjaran->id : null);

        $silabusList = Silabus::where('user_id', $guruId)
            ->when($tahunAjaranId, function ($query, $tahunAjaranId) {
                return $query->where('tahun_ajaran_id', $tahunAjaranId);
            })
            ->orderBy('created_at', 'asc')
            ->paginate(7);

        $tahunAjaranList = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();

        return view('guru.materi.silabus.index', compact('silabusList', 'tahunAjaranList'));
    }

    public function create()
    {
        $tahunKurikulum = TahunKurikulum::all();
        $kelas = Kelas::all();
        $loggedInUserId = Auth::id();
        $tahunAjaran = TahunAjaran::all();

        $users = User::where('role', 'guru')->where('id', $loggedInUserId)->get();
        $selectedKelas = request()->has('kelas_id') ? Kelas::find(request('kelas_id')) : null;
        $tahun_kurikulum_id = $selectedKelas ? $selectedKelas->tahun_kurikulum_id : null;

        return view('guru.materi.silabus.create', compact('kelas', 'tahunKurikulum', 'users', 'tahunAjaran'));
    }

    public function store(Request $request)
    {
        $loggedInUserId = Auth::id();

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_kurikulum_id' => 'required|exists:tahun_kurikulum,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'deskripsi' => 'nullable|string',
            'hasil_kursus' => 'nullable|string',
            'tipe_pembelajaran' => 'nullable|string',
            'penilaian' => 'nullable|string',
            'konten_kursus' => 'nullable|string',
            'buku_pegangan_dan_referensi' => 'nullable|string',
            'alat' => 'nullable|string',
        ]);

        $existingSilabus = Silabus::where('kelas_id', $request->kelas_id)
            ->where('tahun_kurikulum_id', $request->tahun_kurikulum_id)
            ->first();

        if ($existingSilabus) {
            return redirect()->back()->withErrors(['kelas_id' => 'Silabus for the selected class and curriculum year already exists.']);
        }

        $input = $request->all();
        $input['tanggal_publish'] = now();
        $input['user_id'] = $loggedInUserId;

        Silabus::create($input);

        return redirect()->route('silabus.index')->with('success', 'Silabus successfully added.');
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
        $tahunAjaran = TahunAjaran::all();

        return view('guru.materi.silabus.edit', compact('silabus', 'kelas', 'tahunKurikulum', 'tahunAjaran'));
    }

    public function update(Request $request, string $id)
    {
        $silabus = Silabus::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_kurikulum_id' => 'required|exists:tahun_kurikulum,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'deskripsi' => 'nullable|string',
            'hasil_kursus' => 'nullable|string',
            'tipe_pembelajaran' => 'nullable|string',
            'penilaian' => 'nullable|string',
            'konten_kursus' => 'nullable|string',
            'buku_pegangan_dan_referensi' => 'nullable|string',
            'alat' => 'nullable|string',
        ]);

        $existingSilabus = Silabus::where('kelas_id', $request->kelas_id)
            ->where('tahun_kurikulum_id', $request->tahun_kurikulum_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingSilabus) {
            return redirect()->back()->withErrors(['kelas_id' => 'Silabus for the selected class and curriculum year already exists.']);
        }

        $silabus->update($request->all());

        return redirect()->route('silabus.index')->with('success', 'Silabus successfully updated.');
    }

    public function destroy(string $id)
    {
        $silabus = Silabus::find($id);
        $silabus->delete();

        return redirect()->route('silabus.index')->with('success', 'Silabus successfully deleted.');
    }
}
