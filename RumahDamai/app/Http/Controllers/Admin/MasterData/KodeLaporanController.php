<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\KodeLaporan;
use Illuminate\Http\Request;

class KodeLaporanController extends Controller
{
    public function index()
    {
        $kodeLaporanList = KodeLaporan::paginate(10);
        return view('admin.masterdata.kodeLaporan.index', compact('kodeLaporanList'));
    }

    public function create()
    {
        return view('admin.masterdata.kodeLaporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kode_laporan',
        ], [
            'kode.unique' => 'Kode laporan sudah ada, tidak boleh duplikat.',
        ]);

        $word = strtoupper($request->kode); // Ubah kata menjadi huruf besar
        $uniqueCode = $this->generateUniqueCode($word); // Generate kode unik (huruf besar)
        $kodeLaporan = new KodeLaporan(['kode' => $uniqueCode]); // Buat objek KodeLaporan dengan kode unik
        $kodeLaporan->save();

        return redirect()->route('admin.kodeLaporan.index')->with('success', 'Format Laporan berhasil disimpan.');
    }

    public function show($id)
    {
        $kodeLaporan = KodeLaporan::findOrFail($id);
        return view('admin.masterdata.kodeLaporan.show', compact('kodeLaporan'));
    }

    public function edit($id)
    {
        $kodeLaporan = KodeLaporan::findOrFail($id);
        return view('admin.masterdata.kodeLaporan.edit', compact('kodeLaporan'));
    }

    public function update(Request $request, $id)
    {
        $kodeLaporan = KodeLaporan::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:kode_laporan,kode,' . $id,
        ], [
            'kode.unique' => 'Kode laporan sudah ada, tidak boleh duplikat.',
        ]);

        $kodeLaporan->update([
            'kode' => $request->kode,
        ]);

        return redirect()->route('admin.kodeLaporan.index')->with('success', 'Format Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kodeLaporan = KodeLaporan::findOrFail($id);
        $kodeLaporan->delete();

        return redirect()->route('admin.kodeLaporan.index')->with('success', 'Format Laporan berhasil dihapus.');
    }

    private function generateUniqueCode($word)
    {
        return strtoupper($word); // Mengubah kata menjadi huruf besar
    }
}
