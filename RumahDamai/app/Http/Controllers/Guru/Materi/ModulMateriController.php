<?php

namespace App\Http\Controllers\Guru\Materi;

use App\Models\JadwalPembelajaran;
use App\Models\Kelas;
use App\Models\MingguPembelajaran;
use App\Models\ModulMateri;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ModulMateriController extends Controller
{
    public function index(Request $request)
    {
        $guruId = Auth::id();
        $guru = Auth::user();
        $lokasiPenugasanId = $guru->lokasi_penugasan_id;

        // Filter Tahun Ajaran
        $currentYear = now()->year;
        $tahunAjaran = TahunAjaran::where('tahun_ajaran', $currentYear)->first();
        $tahunAjaranId = $request->input('tahun_ajaran_id') ?: ($tahunAjaran ? $tahunAjaran->id : null);

        // Filter Minggu Pembelajaran
        $mingguPembelajaranId = $request->input('minggu_pembelajaran_id') ?: null;

        // Fetch Modul Materi berdasarkan Tahun Ajaran dan Minggu Pembelajaran
        $modulMateriList = ModulMateri::where('user_id', $guruId)
            ->when($tahunAjaranId, function ($query, $tahunAjaranId) {
                return $query->where('tahun_ajaran_id', $tahunAjaranId);
            })
            ->when($mingguPembelajaranId, function ($query, $mingguPembelajaranId) {
                return $query->where('minggu_pembelajaran_id', $mingguPembelajaranId);
            })
            ->with('mingguPembelajaran')
            ->orderBy('created_at', 'asc')
            ->paginate(7);

        // Get all available Tahun Ajaran dan Minggu Pembelajaran untuk dropdown
        $tahunAjaranList = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();
        $mingguPembelajaranList = MingguPembelajaran::where('lokasi_penugasan_id', $lokasiPenugasanId)
            ->orderBy(DB::raw('CAST(minggu_pembelajaran AS UNSIGNED)'), 'asc')
            ->get();

        return view('guru.materi.modulMateri.index', compact('modulMateriList', 'tahunAjaranList', 'mingguPembelajaranList'));
    }




    public function create()
    {
        $kelas = Kelas::all();
        $tahunAjaran = TahunAjaran::all(); // Fetch all academic years

        // Load MingguPembelajaran based on lokasi_penugasan_id
        $mingguPembelajaran = MingguPembelajaran::where('lokasi_penugasan_id', auth()->user()->lokasi_penugasan_id)->get();

        $tahun_kurikulum_id = null;

        if (request()->has('kelas_id')) {
            $selectedKelasId = request()->input('kelas_id');
            $selectedKelas = Kelas::find($selectedKelasId);

            if ($selectedKelas) {
                $tahun_kurikulum_id = $selectedKelas->tahun_kurikulum_id;
            }
        }

        return view('guru.materi.modulMateri.create', compact('kelas', 'mingguPembelajaran', 'tahun_kurikulum_id', 'tahunAjaran'));
    }



    public function store(Request $request)
    {
        $messages = [
            'kelas_id.required' => 'Kelas harus dipilih.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
            'nama_materi.required' => 'Nama materi harus diisi.',
            'nama_materi.string' => 'Nama materi harus berupa teks.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'minggu_pembelajaran_id.required' => 'Minggu pembelajaran harus dipilih.',
            'minggu_pembelajaran_id.exists' => 'Minggu pembelajaran yang dipilih tidak valid.',
            'file_modul.required' => 'File modul harus diunggah.',
            'file_modul.mimes' => 'File modul harus berupa PDF, DOC, atau DOCX.',
            'file_modul.max' => 'File modul tidak boleh lebih besar dari 2048 KB.',
            'tahun_ajaran.required' => 'Tahun ajaran harus diisi.',
            'tahun_ajaran.string' => 'Tahun ajaran harus berupa teks.',
        ];

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama_materi' => 'required|string',
            'deskripsi' => 'nullable|string',
            'minggu_pembelajaran_id' => 'required|exists:minggu_pembelajaran,id',
            'file_modul' => 'required|mimes:pdf,doc,docx|max:2048',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
        ], $messages);

        $user = Auth::user();
        $kelas = Kelas::findOrFail($request->kelas_id);
        $tahun_kurikulum_id = $kelas->tahun_kurikulum_id;

        $modulMateri = new ModulMateri([
            'kelas_id' => $request->kelas_id,
            'nama_materi' => $request->nama_materi,
            'deskripsi' => $request->deskripsi,
            'user_id' => $user->id,
            'tahun_kurikulum_id' => $tahun_kurikulum_id,
            'minggu_pembelajaran_id' => $request->minggu_pembelajaran_id,
            'tanggal_publish' => now(),
            'tahun_ajaran_id' => $request->tahun_ajaran_id, // Corrected line to save the tahun_ajaran_id
        ]);

        if ($request->hasFile('file_modul')) {
            $file = $request->file('file_modul');
            $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file yang diunggah

            // Pindahkan file ke direktori tujuan
            $file->move(public_path('uploads/documents'), $fileName);

            $modulMateri->file_modul = $fileName; // Simpan nama file ke database
        }

        $modulMateri->save();

        $this->tambahJadwalPembelajaran($modulMateri);

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $modulMateri = ModulMateri::with('kelas')->find($id); // Mengubah 'anak' menjadi 'kelas'
        return view('guru.materi.modulMateri.show', compact('modulMateri'));
    }

    public function edit(string $id)
    {
        $modulMateri = ModulMateri::findOrFail($id);
        $kelas = Kelas::all(); // Fetch all classes
        $tahunAjaran = TahunAjaran::all(); // Fetch all academic years

        // Load MingguPembelajaran based on lokasi_penugasan_id
        $mingguPembelajaran = MingguPembelajaran::where('lokasi_penugasan_id', auth()->user()->lokasi_penugasan_id)->get();

        return view('guru.materi.modulMateri.edit', compact('modulMateri', 'kelas', 'mingguPembelajaran', 'tahunAjaran'));
    }


    public function update(Request $request, string $id)
    {
        $messages = [
            'kelas_id.required' => 'Kelas harus dipilih.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
            'nama_materi.required' => 'Nama materi harus diisi.',
            'nama_materi.string' => 'Nama materi harus berupa teks.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'file_modul.mimes' => 'File modul harus berupa PDF, DOC, atau DOCX.',
            'file_modul.max' => 'File modul tidak boleh lebih besar dari 2048 KB.',
            'tahun_ajaran.required' => 'Tahun ajaran harus diisi.',
            'tahun_ajaran.string' => 'Tahun ajaran harus berupa teks.',
        ];

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama_materi' => 'required|string',
            'deskripsi' => 'nullable|string',
            'file_modul' => 'sometimes|mimes:pdf,doc,docx|max:2048',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
        ], $messages);

        $modulMateri = ModulMateri::findOrFail($id);

        // Mendapatkan tahun ajaran dari kelas yang dipilih
        $kelas = Kelas::findOrFail($request->kelas_id);
        $tahun_kurikulum_id = $kelas->tahun_kurikulum_id;

        // Memasukkan nilai 'tahun_kurikulum_id' ke dalam input
        $input = $request->all();
        $input['tahun_kurikulum_id'] = $tahun_kurikulum_id;

        if ($request->hasFile('file_modul')) {
            $file = $request->file('file_modul');
            $originalName = $file->getClientOriginalName(); // Get the original filename

            // Move the file with the original name
            try {
                // Move uploaded file
                $file->move(public_path('uploads/documents'), $originalName);
                Log::info("File uploaded: {$originalName}");

                // Delete old file if it exists
                if ($modulMateri->file_modul && file_exists(public_path('uploads/documents/' . $modulMateri->file_modul))) {
                    unlink(public_path('uploads/documents/' . $modulMateri->file_modul));
                    Log::info("Old file deleted: {$modulMateri->file_modul}");
                }

                // Update the filename to the original filename
                $modulMateri->file_modul = $originalName;
            } catch (\Exception $e) {
                Log::error('Failed to upload file: ' . $e->getMessage());
                return redirect()->back()->withInput()->withErrors(['file_modul' => 'Failed to upload file.']);
            }
        }

        $modulMateri->update($input);

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $modulMateri = ModulMateri::find($id);

        if (!$modulMateri) {
            return redirect()->route('modulMateri.index')->with('error', 'Modul Materi tidak ditemukan.');
        }

        if ($modulMateri->file_modul) {
            $filePath = public_path('uploads/documents/') . $modulMateri->file_modul;
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file dari penyimpanan

                // Hapus file juga dari direktori storage jika menggunakan Storage Facade
                // Storage::disk('public')->delete('uploads/documents/' . $modulMateri->file_modul);
            } else {
                logger('File tidak ditemukan: ' . $filePath); // Logging jika file tidak ditemukan
            }
        }

        // Hapus record ModulMateri
        $modulMateri->delete();

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil dihapus.');
    }

    public function download(string $id)
    {
        $modulMateri = ModulMateri::find($id);

        if (!$modulMateri || !$modulMateri->file_modul) {
            return redirect()->back()->with('error', 'File Modul tidak ditemukan.');
        }

        $filePath = public_path("uploads/documents/{$modulMateri->file_modul}"); // Menggunakan public_path()

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File Modul tidak ditemukan.');
        }

        return response()->file($filePath); // Menggunakan response()->file()
    }

    public function tambahJadwalPembelajaran(ModulMateri $modulMateri)
    {
        // Mendapatkan informasi pengguna yang membuat ModulMateri
        $user = Auth::user();
        $lokasi_penugasan_id = $user->lokasi_penugasan_id ?? null; // Ubah dari 'lokasiPenugasan->id' menjadi 'lokasi_penugasan_id'

        // Membuat objek JadwalPembelajaran dengan nilai lokasi_penugasan_id yang sesuai
        $jadwalPembelajaran = new JadwalPembelajaran([
            'kelas_id' => $modulMateri->kelas_id,
            'minggu_pembelajaran_id' => $modulMateri->minggu_pembelajaran_id,
            'modul_materi_id' => $modulMateri->id,
            'user_id' => $user->id,
            'lokasi_penugasan_id' => $lokasi_penugasan_id, // Menggunakan nilai lokasi_penugasan_id yang sesuai
        ]);

        // Menyimpan objek JadwalPembelajaran ke database
        $jadwalPembelajaran->save();
    }
}
