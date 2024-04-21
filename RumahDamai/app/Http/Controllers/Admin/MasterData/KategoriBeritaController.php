<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriList = KategoriBerita::orderBy('kategori', 'asc')->paginate(7);
        return view('admin.masterdata.kategoriBerita.index', compact('kategoriList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masterdata.kategoriBerita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        KategoriBerita::create($request->all());

        return redirect()->route('kategoriBerita.index')->with('success', 'Data Kategori Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategoriList = KategoriBerita::find($id);
        return view('admin.masterdata.kategoriBerita.show', compact('kategoriList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategoriList = KategoriBerita::find($id);
        return view('admin.masterdata.kategoriBerita.edit', compact('kategoriList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        $kategori = KategoriBerita::find($id);
        $kategori->update($request->all());

        return redirect()->route('kategoriBerita.index')->with('success', 'Data Kategori Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriBerita::find($id);
        $kategori->delete();

        return redirect()->route('kategoriBerita.index')->with('success', 'Data Kategori Berita berhasil dihapus.');
        
    }
}
