<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Kebutuhan;
use Illuminate\Http\Request;

class KebutuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kebutuhanList = Kebutuhan::all();
        return view('admin.masterdata.kebutuhan.index', compact('kebutuhanList'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masterdata.kebutuhan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kebutuhan' => 'required|string',
        ]);

        Kebutuhan::create($request->all());

        return redirect()->route('kebutuhan.index')->with('success', 'Jenis Kebutuhan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $kebutuhan = Kebutuhan::find($id);
        return view('admin.masterdata.kebutuhan.show', compact('kebutuhan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisKebutuhan = Kebutuhan::findOrFail($id);
        return view('admin.masterdata.kebutuhan.edit', compact('jenisKebutuhan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis_kebutuhan' => 'required|string',
        ]);

        $jenisKebutuhan = Kebutuhan::find($id);
        $jenisKebutuhan->update($request->all());

        return redirect()->route('kebutuhan.index')->with('success', 'Jenis Kebutuhan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisKebutuhan = Kebutuhan::findOrFail($id);
        $jenisKebutuhan->delete();

        return redirect()->route('kebutuhan.index')->with('success', 'Jenis Kebutuhan berhasil dihapus.');
    }
}
