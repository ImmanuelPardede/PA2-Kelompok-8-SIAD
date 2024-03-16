<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrangTuaWali;
use App\Models\Agama;
use App\Models\Anak;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class OrangTuaWaliController extends Controller
{
    public function index()
    {
        $orangtuawaliList = OrangTuaWali::orderBy('created_at', 'desc')->get();
        return view('admin.orangTuaWali.index', compact('orangtuawaliList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anak = Anak::all();
        $agama = Agama::all();
        $pekerjaan = Pekerjaan::all();
        return view('admin.orangTuaWali.create', compact('anak', 'agama', 'pekerjaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ibu' => 'required|string',
            'nama_ayah' => 'required|string',
            'tempatLahir' => 'nullable|string',
            'tanggalLahir' => 'nullable|date',
        ]);

        $data = $request->except('_token');
        OrangTuaWali::create($data);

        return redirect()->route('orangTuaWali.index')->with('success', 'Data Orang Tua/Wali berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orangtuawali = OrangTuaWali::with('anak', 'agama')->find($id);
        return view('admin.orangtuawali.show', compact('orangtuawali'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anak = Anak::all();
        $agama = Agama::all();
        $orangtuawali = OrangTuaWali::find($id);
        $pekerjaan = Pekerjaan::all();
        return view('admin.orangTuaWali.edit', compact('orangtuawali', 'anak', 'agama', 'pekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_ibu' => 'required|string',
            'nama_ayah' => 'required|string',
            'tempatLahir' => 'nullable|string',
            'tanggalLahir' => 'nullable|date',
        ]);

        $orangtuawali = OrangTuaWali::find($id);
        $orangtuawali->update($request->all());

        return redirect()->route('orangTuaWali.index')->with('success', 'Data Orang Tua/Wali berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orangtuawali = OrangTuaWali::find($id);
        $orangtuawali->delete();

        return redirect()->route('orangTuaWali.index')->with('success', 'Data Orang Tua/Wali berhasil dihapus.');
    }
}
