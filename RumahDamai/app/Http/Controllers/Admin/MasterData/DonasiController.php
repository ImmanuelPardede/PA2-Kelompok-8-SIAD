<?php

namespace App\Http\Controllers\Admin\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donasi;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donasiList = Donasi::orderBy('jenis_donasi', 'asc')->paginate(7);
        return view('admin.masterdata.donasi.index', compact('donasiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masterdata.donasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_donasi' => 'required|string|unique:donasi,jenis_donasi',
            'deskripsi' => 'required|string',
        ], [
            'jenis_donasi.required' => 'Jenis Donasi wajib diisi.',
            'jenis_donasi.string' => 'Jenis Donasi harus berupa teks.',
            'jenis_donasi.unique' => 'Jenis Donasi sudah ada, tidak boleh duplikat. Harap pastikan jenis donasi yang Anda masukkan belum terdaftar sebelumnya.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ]);

        Donasi::create($request->all());

        return redirect()->route('donasi.index')->with('success', 'Jenis Donasi berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donasi = Donasi::find($id);
        return view('admin.masterdata.donasi.show', compact('donasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisDonasi = Donasi::findOrFail($id);
        return view('admin.masterdata.donasi.edit', compact('jenisDonasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis_donasi' => 'required|string|unique:donasi,jenis_donasi,' . $id,
            'deskripsi' => 'required|string',
        ], [
            'jenis_donasi.required' => 'Jenis Donasi wajib diisi.',
            'jenis_donasi.string' => 'Jenis Donasi harus berupa teks.',
            'jenis_donasi.unique' => 'Jenis Donasi sudah ada, tidak boleh duplikat. Harap pastikan jenis donasi yang Anda masukkan belum terdaftar sebelumnya.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ]);

        $jenisDonasi = Donasi::find($id);
        $jenisDonasi->update($request->all());

        return redirect()->route('donasi.index')->with('success', 'Jenis Donasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisDonasi = Donasi::findOrFail($id);
        $jenisDonasi->delete();

        return redirect()->route('donasi.index')->with('success', 'Jenis Donasi berhasil dihapus.');
    }
}
