<?php

namespace App\Http\Controllers\Guru\PPI\ModelB;

use App\Http\Controllers\Controller;
use App\Models\FormatLaporan;
use App\Models\PpiModelB;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Auth;


class PPIBController extends Controller
{
    public function index()
    {
        $ppiBList = PpiModelB::with('anak')->paginate(10);
        return view('guru.ppi.modelB.index', compact('ppiBList'));
    }

    public function create()
    {
        $anakList = Anak::all();
        $formatLaporanList = FormatLaporan::all(); // Mengambil semua format laporan
        return view('guru.ppi.modelB.create', compact('anakList', 'formatLaporanList'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anak,id',
            'file_ppi_b' => 'nullable|mimes:pdf,doc,docx',
            'deskripsi' => 'nullable|string',
        ]);

        $userRole = Auth::user()->role;

        if ($userRole === 'guru') {
            $filePpiB = null;

            if ($request->hasFile('file_ppi_b')) {
                $file = $request->file('file_ppi_b');
                $filePpiB = time() . '_' . $file->getClientOriginalName(); // Generate unique file name
                $file->storeAs('ppiB_files', $filePpiB, 'public'); // Store file in 'ppiB_files' directory
            }

            PpiModelB::create([
                'anak_id' => $request->anak_id,
                'user_id' => Auth::id(), // Menggunakan Auth::id() untuk mendapatkan ID user yang sedang login
                'file_ppi_b' => $filePpiB,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('ppiB.index')->with('success', 'PPI Model B berhasil disimpan.');
        }

        return redirect()->route('ppiB.index')->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
    }


    public function show($id)
    {
        $ppiB = PpiModelB::findOrFail($id);
        return view('guru.ppi.modelB.show', compact('ppiB'));
    }

    public function edit($id)
    {
        $ppiB = PpiModelB::findOrFail($id);
        $anak = Anak::all();
        $formatLaporanList = FormatLaporan::all();
        return view('guru.ppi.modelB.edit', compact('ppiB', 'anak', 'formatLaporanList'));
    }

    public function update(Request $request, $id)
    {
        $ppiB = PpiModelB::findOrFail($id);

        $request->validate([
            'anak_id' => 'required|exists:anak,id',
            'file_ppi_b' => 'nullable|mimes:pdf,doc,docx',
            'deskripsi' => 'nullable|string',
        ]);

        // Hapus file lama jika ada
        if ($ppiB->file_ppi_b) {
            Storage::disk('public')->delete('ppiB_files/' . $ppiB->file_ppi_b);
        }

        $filePpiB = $ppiB->file_ppi_b; // Gunakan nama file yang sudah ada sebelumnya sebagai default

        if ($request->hasFile('file_ppi_b')) {
            // Upload file baru
            $file = $request->file('file_ppi_b');
            $filePpiB = time() . '_' . $file->getClientOriginalName(); // Generate unique file name
            $file->storeAs('ppiB_files', $filePpiB, 'public'); // Store file in 'ppiB_files' directory
        }

        // Update data PPI B
        $ppiB->update([
            'anak_id' => $request->anak_id,
            'file_ppi_b' => $filePpiB,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('ppiB.index')->with('success', 'PPI Model B berhasil diperbarui.');
    }





    public function destroy($id)
    {
        $ppiB = PpiModelB::findOrFail($id);

        // Hapus file terlebih dahulu jika ada
        if ($ppiB->file_ppi_b) {
            Storage::disk('public')->delete('ppiB_files/' . $ppiB->file_ppi_b);
        }

        // Hapus entitas PPI Model B
        $ppiB->delete();

        return redirect()->route('ppiB.index')->with('success', 'PPI Model B berhasil dihapus.');
    }


    public function downloadPpiB($id)
    {
        $ppiB = PpiModelB::find($id);

        if (!$ppiB || !$ppiB->file_ppi_b) {
            return redirect()->back()->with('error', 'File PPI B tidak ditemukan.');
        }

        $filePath = storage_path("app/public/ppiB_files/{$ppiB->file_ppi_b}");

        if (!Storage::disk('public')->exists("ppiB_files/{$ppiB->file_ppi_b}")) {
            return redirect()->back()->with('error', 'File PPI B tidak ditemukan.');
        }

        return response()->download($filePath, $ppiB->file_ppi_b);
    }


    public function downloadFormatLaporan($id)
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
