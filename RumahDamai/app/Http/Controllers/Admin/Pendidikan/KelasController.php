<?php

namespace App\Http\Controllers\Admin\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\SemesterTahunAjaran;
use App\Models\TahunAjaran;
use App\Models\TahunKurikulum;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelasList = Kelas::orderBy('nama_kelas', 'asc')->paginate(7);
        return view('admin.pendidikan.kelas.index', compact('kelasList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahunKurikulum = TahunKurikulum::all();
        $tahunAjaran = TahunAjaran::all();
        $semesterTahunAjaran = SemesterTahunAjaran::all();
        $loggedInUserId = Auth::id();
        $users = User::where('role', 'admin')->where('id', $loggedInUserId)->get();

        return view('admin.pendidikan.kelas.create', compact('tahunKurikulum', 'tahunAjaran', 'semesterTahunAjaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
        ], [
            'nama_kelas.unique' => 'Nama Kelas sudah digunakan, tidak boleh duplikat.',
        ]);

        // Menyimpan data kelas dengan user_id pengguna yang sedang login
        $kelas = new Kelas($request->all());
        $kelas->user_id = Auth::id();  // Menetapkan user_id ke pengguna yang sedang login
        $kelas->save();

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::find($id);
        return view('admin.pendidikan.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::find($id);
        $tahunKurikulum = TahunKurikulum::all();
        $tahunAjaran = TahunAjaran::all();
        $semesterTahunAjaran = SemesterTahunAjaran::all();
        return view('admin.pendidikan.kelas.edit', compact('kelas', 'tahunKurikulum', 'tahunAjaran', 'semesterTahunAjaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $id,
            'tahun_kurikulum_id' => 'nullable|exists:tahun_kurikulum,id',
        ], [
            'nama_kelas.unique' => 'Nama Kelas sudah digunakan, tidak boleh duplikat.',
        ]);

        $kelas = Kelas::findOrFail($id);

        // Menyimpan data kelas dengan user_id pengguna yang sedang login
        $kelas->fill($request->all());
        $kelas->user_id = Auth::id();  // Menetapkan user_id ke pengguna yang sedang login
        $kelas->save();

        // Mengupdate relasi jika ada
        if ($kelas->tahun_kurikulum_id) {
            $kelas->silabus()->update(['tahun_kurikulum_id' => $kelas->tahun_kurikulum_id]);
            $kelas->modulMateri()->update(['tahun_kurikulum_id' => $kelas->tahun_kurikulum_id]);
        }

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
