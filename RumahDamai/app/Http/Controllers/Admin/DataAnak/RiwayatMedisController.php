<?php

namespace App\Http\Controllers\Admin\DataAnak;

use App\Models\Anak;
use App\Models\Penyakit;
use App\Models\RiwayatMedis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RiwayatMedisController extends Controller
{
    public function index()
    {
        $riwayatmedisList = RiwayatMedis::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.DataAnak.riwayatMedis.index', compact('riwayatmedisList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anak = Anak::all();
        $penyakit = Penyakit::all();
        return view('admin.DataAnak.riwayatMedis.create', compact('anak', 'penyakit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'riwayat_perawatan' => 'required|string',
            'riwayat_perilaku' => 'nullable|string',
            'deskripsi_riwayat' => 'nullable|string',
            'kondisi' => 'nullable|string',
        ]);

        // Bersihkan input dari tag HTML
        $data = $request->except('_token');
        $data['riwayat_perawatan'] = strip_tags($data['riwayat_perawatan']);
        if (isset($data['riwayat_perilaku'])) {
            $data['riwayat_perilaku'] = strip_tags($data['riwayat_perilaku']);
        }
        if (isset($data['deskripsi_riwayat'])) {
            $data['deskripsi_riwayat'] = strip_tags($data['deskripsi_riwayat']);
        }
        if (isset($data['kondisi'])) {
            $data['kondisi'] = strip_tags($data['kondisi']);
        }

        RiwayatMedis::create($data);

        return redirect()->route('admin.riwayatMedis.index')->with('success', 'Riwayat Medis berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $riwayatmedis = RiwayatMedis::with('anak')->find($id);
        return view('admin.DataAnak.riwayatMedis.show', compact('riwayatmedis'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anak = Anak::all();
        $riwayatmedis = RiwayatMedis::find($id);
        return view('admin.DataAnak.riwayatMedis.edit', compact('riwayatmedis', 'anak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'riwayat_perawatan' => 'required|string',
            'riwayat_perilaku' => 'nullable|string',
            'deskripsi_riwayat' => 'nullable|string',
            'kondisi' => 'nullable|string',
        ]);

        // Bersihkan input dari tag HTML
        $data = $request->except('_token');
        $data['riwayat_perawatan'] = strip_tags($data['riwayat_perawatan']);
        if (isset($data['riwayat_perilaku'])) {
            $data['riwayat_perilaku'] = strip_tags($data['riwayat_perilaku']);
        }
        if (isset($data['deskripsi_riwayat'])) {
            $data['deskripsi_riwayat'] = strip_tags($data['deskripsi_riwayat']);
        }
        if (isset($data['kondisi'])) {
            $data['kondisi'] = strip_tags($data['kondisi']);
        }

        $riwayatmedis = RiwayatMedis::find($id);
        $riwayatmedis->update($data);

        return redirect()->route('admin.riwayatMedis.index')->with('success', 'Riwayat Medis berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $riwayatmedis = RiwayatMedis::find($id);
        $riwayatmedis->delete();

        return redirect()->route('admin.riwayatMedis.index')->with('success', 'Riwayat Medis berhasil dihapus.');
    }
}
