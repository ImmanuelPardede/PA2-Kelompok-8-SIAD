<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\Kebutuhan;

class AnakController extends Controller
{

    public function index()
    {
        $anakList = Anak::with('agama','jenisKelamin','golonganDarah','kebutuhan')->get();
        return view('admin.anak.index', compact('anakList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agama = Agama::all();
        $jenisKelamin = JenisKelamin::all();
        $golonganDarah = GolonganDarah::all();
        $jenisKebutuhan = Kebutuhan::all();
        return view('admin.anak.create',compact('agama','jenisKelamin','golonganDarah','jenisKebutuhan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaLengkap' => 'required|string',
            'agama_id' => 'required|string',
            'jenis_kelamin_id' => 'required|string',
            'golongan_darah_id' => 'required|string',
            'kebutuhan_id' => 'required|string',
            'tempatLahir' => 'required|string',
            'nama_ibu' => 'required|string',
        ]);

        Anak::create($request->all());

        return redirect()->route('anak.index')->with('success', 'Data anak berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anak = Anak::find($id);
        return view('admin.anak.show', compact('anak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agama = Agama::all();
        $jenisKelamin = JenisKelamin::all();
        $golonganDarah = GolonganDarah::all();
        $kebutuhan = Kebutuhan::all();
        $anak = Anak::find($id);
        return view('admin.anak.edit', compact('anak','agama', 'jenisKelamin','golonganDarah','kebutuhan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'namaLengkap' => 'required|string',
            'tempatLahir' => 'required|string',
            'tanggalLahir' => 'required|date',
        ]);

        $anak = Anak::find($id);
        $anak->update($request->all());

        return redirect()->route('anak.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anak = Anak::find($id);
        $anak->delete();

        return redirect()->route('anak.index')->with('success', 'Data anak berhasil dihapus.');
    }
}
