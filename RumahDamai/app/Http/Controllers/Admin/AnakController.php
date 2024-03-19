<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\Kebutuhan;
use App\Models\Penyakit;

class AnakController extends Controller
{

    public function index()
    {
        $anakList = Anak::orderBy('created_at', 'desc')->get();
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
        $kebutuhan = Kebutuhan::all();
        $penyakit = Penyakit::all();
        return view('admin.anak.create', compact('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhan', 'penyakit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'tempatLahir' => 'nullable|string',
            'tanggalLahir' => 'nullable|date',
        ]);

        $data = $request->except('_token');
        Anak::create($data);

        return redirect()->route('anak.index')->with('success', 'Data anak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anak = Anak::with('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhan', 'penyakit')->find($id);
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
        $penyakit = Penyakit::all();
        $anak = Anak::find($id);
        return view('admin.anak.edit', compact('anak', 'agama', 'jenisKelamin', 'golonganDarah', 'kebutuhan', 'penyakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'tempatLahir' => 'nullable|string',
            'tanggalLahir' => 'nullable|date',
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
