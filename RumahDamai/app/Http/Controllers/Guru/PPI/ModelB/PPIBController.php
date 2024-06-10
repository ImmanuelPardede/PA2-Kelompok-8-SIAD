<?php

namespace App\Http\Controllers\Guru\PPI\ModelB;

use App\Http\Controllers\Controller;
use App\Models\FormatLaporan;
use App\Models\PpiModelB;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $messages = [
            'anak_id.required' => 'Anak harus dipilih.',
            'anak_id.exists' => 'Anak yang dipilih tidak valid.',
            'file_ppi_b.required' => 'File PPI B harus diunggah.',
            'file_ppi_b.mimes' => 'File PPI B harus berupa PDF, DOC, atau DOCX.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ];

        $request->validate([
            'anak_id' => 'required|exists:anak,id',
            'file_ppi_b' => 'required|mimes:pdf,doc,docx',
            'deskripsi' => 'nullable|string',
        ], $messages);


        $userRole = Auth::user()->role;

        if ($userRole === 'guru') {
            $filePpiB = null;

            if ($request->hasFile('file_ppi_b')) {
                $file = $request->file('file_ppi_b');
                $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file yang diunggah
                $filePpiB = $fileName; // Gunakan nama asli file
                $file->move(public_path('uploads/ppiB_files'), $filePpiB); // Store file in 'ppiB_files' directory
            }

            PpiModelB::create([
                'anak_id' => $request->anak_id,
                'user_id' => Auth::id(),
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

        $messages = [
            'anak_id.required' => 'Anak harus dipilih.',
            'anak_id.exists' => 'Anak yang dipilih tidak valid.',
            'file_ppi_b.mimes' => 'File PPI B harus berupa PDF, DOC, atau DOCX.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
        ];

        $request->validate([
            'anak_id' => 'required|exists:anak,id',
            'file_ppi_b' => 'nullable|mimes:pdf,doc,docx',
            'deskripsi' => 'nullable|string|required',
        ], $messages);

        $filePpiB = $ppiB->file_ppi_b;

        if ($request->hasFile('file_ppi_b')) {
            $file = $request->file('file_ppi_b');
            $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file yang diunggah
            $newFilePpiB = $fileName; // Gunakan nama asli file
            $file->move(public_path('uploads/ppiB_files'), $newFilePpiB); // Store file in 'ppiB_files' directory

            // Hapus file lama jika ada
            if ($ppiB->file_ppi_b && file_exists(public_path('uploads/ppiB_files/' . $ppiB->file_ppi_b))) {
                unlink(public_path('uploads/ppiB_files/' . $ppiB->file_ppi_b));
            }

            $filePpiB = $newFilePpiB;
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
        if ($ppiB->file_ppi_b && file_exists(public_path('uploads/ppiB_files/' . $ppiB->file_ppi_b))) {
            unlink(public_path('uploads/ppiB_files/' . $ppiB->file_ppi_b));
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

        $filePath = public_path("uploads/ppiB_files/{$ppiB->file_ppi_b}");

        if (!file_exists($filePath)) {
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

        $filePath = public_path("uploads/format_laporan/{$formatLaporan->format_laporan}");

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File Format Laporan tidak ditemukan.');
        }

        // Menggunakan nama file asli sebagai nama file yang akan didownload
        $originalFileName = pathinfo($formatLaporan->format_laporan, PATHINFO_FILENAME);
        $extension = pathinfo($formatLaporan->format_laporan, PATHINFO_EXTENSION);

        return response()->download($filePath, $originalFileName . '.' . $extension);
    }
}
