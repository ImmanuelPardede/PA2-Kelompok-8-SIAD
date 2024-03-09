<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\LokasiTugas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LokasiTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasiList = LokasiTugas::orderBy('wilayah', 'asc')->get();
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
            'lokasi' => 'required|string',
            'wilayah' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        LokasiTugas::create($request->all());

        return redirect()->route('lokasiTugas.index')->with('success', 'Lokasi Tugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $lokasi_penugasan_id)
    {
        $lokasi = LokasiTugas::findOrFail($lokasi_penugasan_id);
        return view('admin.masterdata.lokasiTugas.show', compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $lokasi_penugasan_id)
    {
        $lokasiPenugasan = LokasiTugas::findOrFail($lokasi_penugasan_id);
        return view('admin.masterdata.lokasiTugas.edit', compact('lokasiPenugasan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $lokasi_penugasan_id)
    {
        $request->validate([
            'lokasi' => 'required|string',
            'wilayah' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $lokasiPenugasan = LokasiTugas::findOrFail($lokasi_penugasan_id);
        $lokasiPenugasan->update($request->all());

        return redirect()->route('lokasiTugas.index')->with('success', 'Lokasi Tugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $lokasi_penugasan_id): RedirectResponse
    {
        $lokasiPenugasan = LokasiTugas::findOrFail($lokasi_penugasan_id);
        $lokasiPenugasan->delete();

        return redirect()->route('lokasiTugas.index')->with('success', 'Lokasi Tugas berhasil dihapus.');
    }
}
