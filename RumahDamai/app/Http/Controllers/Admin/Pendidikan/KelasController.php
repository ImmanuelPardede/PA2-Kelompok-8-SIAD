<?php

namespace App\Http\Controllers\Admin\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\TahunKurikulum;
use Illuminate\Http\Request;
use App\Models\Kelas;

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
        return view('admin.pendidikan.kelas.create', compact('tahunKurikulum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'nullable|string',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
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
        return view('admin.pendidikan.kelas.edit', compact('kelas', 'tahunKurikulum'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kelas' => 'nullable|string',
            'tahun_kurikulum_id' => 'nullable|exists:tahun_kurikulum,id', // tambahkan validasi untuk tahun_kurikulum_id
        ]);

        $kelas = Kelas::findOrFail($id);

        // Update data kelas
        $kelas->fill($request->all())->save();

        // Update tahun_kurikulum_id di tabel Silabus yang terkait dengan kelas ini
        $kelas->silabus()->update(['tahun_kurikulum_id' => $kelas->tahun_kurikulum_id]);

        // Update tahun_kurikulum_id di tabel ModulMateri yang terkait dengan kelas ini
        $kelas->modulMateri()->update(['tahun_kurikulum_id' => $kelas->tahun_kurikulum_id]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
