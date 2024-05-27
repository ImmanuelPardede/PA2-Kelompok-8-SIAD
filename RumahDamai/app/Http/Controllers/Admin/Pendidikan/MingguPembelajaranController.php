<?php

namespace App\Http\Controllers\Admin\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\LokasiTugas;
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
        return view('admin.pendidikan.mingguPembelajaran.index', compact('mingguPembelajaranList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lokasiPenugasanList = LokasiTugas::orderBy('lokasi', 'asc')->get(); // Ambil semua lokasi penugasan
        return view('admin.pendidikan.mingguPembelajaran.create', compact('lokasiPenugasanList'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'minggu_pembelajaran' => 'required|string',
            'tanggal_mulai' => 'required|date_format:Y-m-d',
            'tanggal_berakhir' => 'required|date_format:Y-m-d',
            'lokasi_penugasan_id' => 'required|exists:lokasi_penugasan,id',
        ]);

        // Check for duplicate entry
        $duplicateCheck = MingguPembelajaran::where([
            'minggu_pembelajaran' => $request->minggu_pembelajaran,
            'lokasi_penugasan_id' => $request->lokasi_penugasan_id,
        ])->exists();

        if ($duplicateCheck) {
            return redirect()->back()->with('error', 'Data Minggu Pembelajaran sudah ada.');
        }

        MingguPembelajaran::create([
            'minggu_pembelajaran' => $request->minggu_pembelajaran,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'lokasi_penugasan_id' => $request->lokasi_penugasan_id,
        ]);

        return redirect()->route('admin.mingguPembelajaran.index')->with('success', 'Minggu Pembelajaran berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mingguPembelajaran = MingguPembelajaran::findOrFail($id);
        return view('admin.pendidikan.mingguPembelajaran.show', compact('mingguPembelajaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mingguPembelajaran = MingguPembelajaran::findOrFail($id);
        $lokasiPenugasanList = LokasiTugas::orderBy('lokasi', 'asc')->get(); // Get all lokasi penugasan
        return view('admin.pendidikan.mingguPembelajaran.edit', compact('mingguPembelajaran', 'lokasiPenugasanList'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'minggu_pembelajaran' => 'required|string',
            'tanggal_mulai' => 'required|date_format:Y-m-d',
            'tanggal_berakhir' => 'required|date_format:Y-m-d',
            'lokasi_penugasan_id' => 'required|exists:lokasi_penugasan,id',
        ]);

        // Check for duplicate entry
        $duplicateCheck = MingguPembelajaran::where([
            'minggu_pembelajaran' => $request->minggu_pembelajaran,
            'lokasi_penugasan_id' => $request->lokasi_penugasan_id,
        ])->where('id', '!=', $id)->exists();

        if ($duplicateCheck) {
            return redirect()->back()->with('error', 'Data Minggu Pembelajaran sudah ada.');
        }

        $mingguPembelajaran = MingguPembelajaran::findOrFail($id);
        $mingguPembelajaran->update([
            'minggu_pembelajaran' => $request->minggu_pembelajaran,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'lokasi_penugasan_id' => $request->lokasi_penugasan_id,
        ]);

        return redirect()->route('admin.mingguPembelajaran.index')->with('success', 'Minggu Pembelajaran berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mingguPembelajaran = MingguPembelajaran::findOrFail($id);
        $mingguPembelajaran->delete();

        return redirect()->route('admin.mingguPembelajaran.index')->with('success', 'Minggu Pembelajaran berhasil dihapus.');
    }
}
