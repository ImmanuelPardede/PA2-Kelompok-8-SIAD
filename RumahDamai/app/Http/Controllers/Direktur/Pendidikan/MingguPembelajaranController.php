<?php

namespace App\Http\Controllers\Direktur\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\MingguPembelajaran;
use Illuminate\Http\Request;

class MingguPembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mingguPembelajaranList = MingguPembelajaran::orderBy('id', 'asc')->paginate(7);
        return view('direktur.pendidikan.mingguPembelajaran.index', compact('mingguPembelajaranList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('direktur.pendidikan.mingguPembelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'minggu_pembelajaran' => 'required|string',
        ]);

        MingguPembelajaran::create([
            'minggu_pembelajaran' => $request->minggu_pembelajaran,
        ]);

        return redirect()->route('direktur.mingguPembelajaran.index')->with('success', 'Tahun Kurikulum berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mingguPembelajaran = MingguPembelajaran::findOrFail($id);
        return view('direktur.pendidikan.mingguPembelajaran.show', compact('mingguPembelajaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mingguPembelajaran = MingguPembelajaran::findOrFail($id);
        return view('direktur.pendidikan.mingguPembelajaran.edit', compact('mingguPembelajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'minggu_pembelajaran' => 'required|string',
        ]);

        $mingguPembelajaran = MingguPembelajaran::findOrFail($id);
        $mingguPembelajaran->update([
            'minggu_pembelajaran' => $request->minggu_pembelajaran,
        ]);

        return redirect()->route('direktur.mingguPembelajaran.index')->with('success', 'Tahun Kurikulum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mingguPembelajaran = MingguPembelajaran::findOrFail($id);
        $mingguPembelajaran->delete();

        return redirect()->route('direktur.mingguPembelajaran.index')->with('success', 'Tahun Kurikulum berhasil dihapus.');
    }
}
