<?php

namespace App\Http\Controllers\Guru\PPI\ModelB;

use App\Http\Controllers\Controller;
use App\Models\DetailPpiB;
use App\Models\FormatLaporan;
use App\Models\PpiModelB;
use App\Models\Anak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Add this line


class PPIBController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        // Combine conditions for filtering 'tipe_anak' and search query with grouping
        $anak = Anak::where('tipe_anak', 'non_disabilitas')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where(function ($subQuery) use ($query) {
                    $subQuery->where('nama_lengkap', 'like', "%{$query}%")
                        ->orWhere('status', 'like', "%{$query}%");
                });
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('guru.ppi.modelB._table', ['anak' => $anak])->render();
        }

        return view('guru.ppi.modelB.index', compact('anak'));
    }

    public function show($id)
    {
        $anak = Anak::all();
        $ppiB = PpiModelB::where('anak_id', $id)->get();
        return view('guru.ppi.modelB.show', compact('ppiB', 'anak', 'id'));
    }

    public function detail($id)
    {
        $ppiB = PpiModelB::findOrFail($id);
        $detailppi = DetailPpiB::where('ppiB_id', $id)->get(); // Pastikan variabel ini terdefinisi
        return view('guru.ppi.modelB.detail', compact('ppiB', 'detailppi'));
    }

    public function create($anak_id)
    {
        $anak = Anak::findOrFail($anak_id);
        $ppiB = PpiModelB::where('anak_id', $anak_id)->get();

        $formatLaporanList = FormatLaporan::all(); // Retrieve format laporan if needed

        return view('guru.ppi.modelB.create', compact('anak', 'ppiB', 'formatLaporanList', 'anak_id'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'anak_id' => 'required|exists:anak,id',
        'file_ppi_b' => 'required|mimes:pdf,doc,docx',
        'deskripsi' => 'nullable|string',
    ]);

    // Mengelola file yang diunggah
    if ($request->hasFile('file_ppi_b')) {
        $file = $request->file('file_ppi_b');
        $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file yang diunggah
        $filePpiB = $fileName; // Gunakan nama asli file
        $file->move(public_path('uploads/ppiB_files'), $filePpiB); // Simpan file di direktori 'ppiB_files'
    } else {
        return redirect()->back()->withInput()->withErrors(['file_ppi_b' => 'File PPI B harus diunggah.']);
    }

    try {
        // Buat entri PpiModelB baru
        $ppiB = new PpiModelB();
        $ppiB->anak_id = $request->input('anak_id');
        $ppiB->user_id = Auth::id(); // Assign logged in user ID
        $ppiB->save();

        // Buat entri DetailPpiB baru
        $detailPpiB = new DetailPpiB();
        $detailPpiB->ppiB_id = $ppiB->id;
        $detailPpiB->file_ppi_b = $filePpiB; // Menyimpan nama file yang diunggah
        $detailPpiB->deskripsi = $request->input('deskripsi');
        $detailPpiB->save();

        // Redirect ke halaman raport dengan pesan sukses
        return redirect()->route('ppiB.show', ['id' => $ppiB->anak_id])->with('success', 'Raport berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
    }
}


    public function edit($id)
    {
        $ppiB = PpiModelB::findOrFail($id);
        $anak = Anak::findOrFail($ppiB->anak_id);
        $detailppi = DetailPpiB::where('ppiB_id', $id)->firstOrFail();

        return view('guru.ppi.modelB.edit', compact('ppiB', 'anak', 'detailppi'));
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
            'deskripsi' => 'required|string',
        ], $messages);

        $detailPpiB = DetailPpiB::where('ppiB_id', $ppiB->id)->firstOrFail();

        if ($request->hasFile('file_ppi_b')) {
            $file = $request->file('file_ppi_b');
            $originalName = $file->getClientOriginalName(); // Get the original filename

            // Move the file with the original name
            try {
                // Move uploaded file
                $file->move(public_path('uploads/ppiB_files'), $originalName);
                Log::info("File uploaded: {$originalName}");

                // Delete old file if it exists
                if ($detailPpiB->file_ppi_b && file_exists(public_path('uploads/ppiB_files/' . $detailPpiB->file_ppi_b))) {
                    unlink(public_path('uploads/ppiB_files/' . $detailPpiB->file_ppi_b));
                    Log::info("Old file deleted: {$detailPpiB->file_ppi_b}");
                }

                // Update the filename to the original filename
                $detailPpiB->file_ppi_b = $originalName;
            } catch (\Exception $e) {
                Log::error('Failed to upload file: ' . $e->getMessage());
                return redirect()->back()->withInput()->withErrors(['file_ppi_b' => 'Failed to upload file.']);
            }
        }

        try {
            // Update PpiModelB and DetailPpiB
            $ppiB->anak_id = $request->input('anak_id');
            $ppiB->user_id = Auth::id();
            $ppiB->save();
            Log::info("PpiModelB ID {$id} updated.");

            $detailPpiB->deskripsi = $request->input('deskripsi');
            $detailPpiB->save();
            Log::info("DetailPpiB ID {$detailPpiB->id} updated.");

            return redirect()->route('ppiB.show', ['id' => $ppiB->anak_id])->with('success', 'PPI Model B berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating PPI B: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function destroy($id)
    {
        // Ambil informasi anak terkait dengan raport yang akan dihapus
        $ppiB = PpiModelB::findOrFail($id);
        $anakId = $ppiB->anak_id;

        // Ambil detail terkait untuk mendapatkan nama file
        $detailPpiB = DetailPpiB::where('ppiB_id', $id)->first();

        // Hapus terlebih dahulu semua detailraports terkait
        DetailPpiB::where('ppiB_id', $id)->delete();

        // Hapus file jika ada
        if ($detailPpiB && $detailPpiB->file_ppi_b) {
            $filePath = public_path('uploads/ppiB_files/' . $detailPpiB->file_ppi_b);
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file
                Log::info("File deleted: {$detailPpiB->file_ppi_b}");
            }
        }

        // Kemudian hapus Raport
        $ppiB->delete();

        return redirect()->route('ppiB.show', ['id' => $anakId])->with('success', 'Raport berhasil dihapus.');
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
