<?php

namespace App\Http\Controllers\Direktur\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\FormatLaporan;
use App\Models\KodeLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormatLaporanController extends Controller
{
    public function index()
    {
        $formatLaporanList = FormatLaporan::paginate(10);
        return view('direktur.Pendidikan.formatLaporan.index', compact('formatLaporanList'));
    }

    public function create()
    {
        $kodeLaporan = KodeLaporan::all();
        return view('direktur.Pendidikan.formatLaporan.create', compact('kodeLaporan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_laporan' => 'required|unique:format_laporan,kode_laporan_id',
            'nama_laporan' => 'required',
            'format_laporan' => 'required|file|mimes:pdf,doc,docx',
        ]);

        // Handle file upload
        $formatLaporan = null;
        if ($request->hasFile('format_laporan')) {
            $file = $request->file('format_laporan');
            $formatLaporan = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('format_laporan', $formatLaporan, 'public');
        }

        FormatLaporan::create([
            'kode_laporan_id' => $request->kode_laporan,
            'format_laporan' => $formatLaporan,
            'nama_laporan' => $request->nama_laporan,
        ]);

        return redirect()->route('direktur.formatLaporan.index')->with('success', 'Format Laporan berhasil disimpan.');
    }

    public function show($id)
    {
        $formatLaporan = FormatLaporan::findOrFail($id);
        return view('direktur.Pendidikan.formatLaporan.show', compact('formatLaporan'));
    }

    public function edit($id)
    {
        $formatLaporan = FormatLaporan::findOrFail($id);
        $kodeLaporan = KodeLaporan::all();
        return view('direktur.Pendidikan.formatLaporan.edit', compact('formatLaporan', 'kodeLaporan'));
    }

    public function update(Request $request, $id)
    {
        $formatLaporan = FormatLaporan::findOrFail($id);

        $request->validate([
            'kode_laporan' => 'required|unique:format_laporan,kode_laporan_id,' . $id,
            'nama_laporan' => 'required',
            'format_laporan' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // Handle file upload
        $fileformatLaporan = $formatLaporan->format_laporan;
        if ($request->hasFile('format_laporan')) {
            if ($formatLaporan->format_laporan) {
                Storage::disk('public')->delete('format_laporan/' . $formatLaporan->format_laporan);
            }

            $file = $request->file('format_laporan');
            $fileformatLaporan = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('format_laporan', $fileformatLaporan, 'public');
        }

        $formatLaporan->update([
            'kode_laporan_id' => $request->kode_laporan,
            'format_laporan' => $fileformatLaporan,
            'nama_laporan' => $request->nama_laporan,
        ]);

        return redirect()->route('direktur.formatLaporan.index')->with('success', 'Format Laporan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $formatLaporan = FormatLaporan::findOrFail($id);

        if ($formatLaporan->format_laporan) {
            Storage::disk('public')->delete('format_laporan/' . $formatLaporan->format_laporan);
        }

        $formatLaporan->delete();

        return redirect()->route('direktur.formatLaporan.index')->with('success', 'Format Laporan berhasil dihapus.');
    }

    public function download($id)
    {
        $formatLaporan = FormatLaporan::find($id);

        if (!$formatLaporan || !$formatLaporan->format_laporan) {
            return redirect()->back()->with('error', 'File Format Laporan tidak ditemukan.');
        }

        $filePath = storage_path("app/public/format_laporan/{$formatLaporan->format_laporan}");

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File Format Laporan tidak ditemukan.');
        }

        // Menggunakan nama file asli sebagai nama file yang akan didownload
        $originalFileName = pathinfo($formatLaporan->format_laporan, PATHINFO_FILENAME);
        $extension = pathinfo($formatLaporan->format_laporan, PATHINFO_EXTENSION);

        return response()->download($filePath, $originalFileName . '.' . $extension);
    }
}
