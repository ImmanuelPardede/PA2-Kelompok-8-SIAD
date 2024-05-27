<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\LokasiTugas;
use Illuminate\Http\Request;

class LokasiTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasiList = LokasiTugas::orderBy('wilayah', 'asc')->paginate(7);
        return view('admin.masterdata.lokasiTugas.index', compact('lokasiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masterdata.lokasiTugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|string|unique:lokasi_penugasan',
            'wilayah' => 'required|string|unique:lokasi_penugasan',
            'deskripsi' => 'required|string',
        ], [
            'lokasi.unique' => 'Lokasi sudah ada, tidak boleh duplikat.',
            'wilayah.unique' => 'Wilayah sudah ada, tidak boleh duplikat.',
        ]);

        LokasiTugas::create($request->all());

        return redirect()->route('lokasiTugas.index')->with('success', 'Lokasi Tugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lokasi = LokasiTugas::findOrFail($id);
        return view('admin.masterdata.lokasiTugas.show', compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lokasiPenugasan = LokasiTugas::findOrFail($id);
        return view('admin.masterdata.lokasiTugas.edit', compact('lokasiPenugasan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lokasi' => 'required|string|unique:lokasi_penugasan,lokasi,' . $id,
            'wilayah' => 'required|string|unique:lokasi_penugasan,wilayah,' . $id,
            'deskripsi' => 'required|string',
        ], [
            'lokasi.unique' => 'Lokasi sudah ada, tidak boleh duplikat.',
            'wilayah.unique' => 'Wilayah sudah ada, tidak boleh duplikat.',
        ]);

        $lokasiPenugasan = LokasiTugas::findOrFail($id);
        $lokasiPenugasan->update($request->all());

        return redirect()->route('lokasiTugas.index')->with('success', 'Lokasi Tugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasiPenugasan = LokasiTugas::findOrFail($id);
        $lokasiPenugasan->delete();

        return redirect()->route('lokasiTugas.index')->with('success', 'Lokasi Tugas berhasil dihapus.');
    }
}
