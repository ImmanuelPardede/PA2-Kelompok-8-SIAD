<?php

namespace App\Http\Controllers\Direktur\DataAnak;

use App\Exports\ExportAnak;
use App\Http\Controllers\Controller;
use App\Models\AnakDisabilitas;
use App\Models\AnakNonDisabilitas;
use App\Models\Disabilitas;
use App\Models\NonDisabilitas;
use App\Models\KebutuhanDisabilitas;
use Illuminate\Http\Request;
use App\Models\LokasiTugas;
use App\Models\Anak;
use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\Penyakit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class AnakController extends Controller
{

    // In your AnakController.php

    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $anakList = Anak::where('nama_lengkap', 'like', "%{$search}%")
                ->orderBy('created_at', 'desc')
                ->paginate(7);
        } else {
            $anakList = Anak::orderBy('created_at', 'desc')->paginate(7);
        }

        return view('direktur.DataAnak.Anak.index', compact('anakList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lokasiTugas = LokasiTugas::all();
        $agama = Agama::all();
        $jenisKelamin = JenisKelamin::all();
        $golonganDarah = GolonganDarah::all();
        $kebutuhanDisabilitas = KebutuhanDisabilitas::all();
        $penyakit = Penyakit::all();
        return view('direktur.DataAnak.Anak.create', compact('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhanDisabilitas', 'penyakit', 'lokasiTugas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'required|string',
            'agama_id' => 'required',
            'nia' => 'nullable',
            'jenis_kelamin_id' => 'required',
            'golongan_darah_id' => 'required',
            'tipe_anak' => 'required|in:disabilitas,non_disabilitas',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'lokasi_id' => 'required',
            'kebutuhan_disabilitas_id' => 'nullable',
            'disukai' => 'nullable|string',
            'tidak_disukai' => 'nullable|string',
            'alamat' => 'required|string',
            'kelebihan' => 'nullable|string',
            'kekurangan' => 'nullable|string',
        ]);

        try {


            // Generate NIA
            $lokasi_id = str_pad($request->lokasi_id ?? 0, 1, '0', STR_PAD_LEFT);
            $tipe_anak = $request->tipe_anak == 'disabilitas' ? '01' : '02';
            $tahun_masuk = date('y');
            $tahun_lahir = substr(date('Y', strtotime($request->tanggal_lahir)), -2);

            $latest_anak = Anak::where('lokasi_id', $request->lokasi_id)
                ->where('tipe_anak', $request->tipe_anak)
                ->latest()
                ->first();

            $nomor_urut = $latest_anak ? ((int) substr($latest_anak->nia, -3)) + 1 : 1;

            $nia = $lokasi_id . $tipe_anak . $tahun_masuk . $tahun_lahir . str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);


            $anak = Anak::create([
                'nama_lengkap' => $request->nama_lengkap,
                'agama_id' => $request->agama_id,
                'jenis_kelamin_id' => $request->jenis_kelamin_id,
                'golongan_darah_id' => $request->golongan_darah_id,
                'kebutuhan_disabilitas_id' => $request->kebutuhan_disabilitas_id,
                'penyakit_id' => $request->penyakit_id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'disukai' => $request->disukai,
                'tidak_disukai' => $request->tidak_disukai,
                'alamat' => $request->alamat,
                'kelebihan' => $request->kelebihan,
                'kekurangan' => $request->kekurangan,
                'status' => 'aktif',
                'lokasi_id' => $request->lokasi_id,
                'tanggal_masuk' => now(),
                'tipe_anak' => $request->tipe_anak,
                'nia' => $nia, // Simpan NIA yang baru diambil
                'user_id' => Auth::id(), // Assign logged in user ID
            ]);

            // Mengelola upload foto profil
            if ($request->hasFile('foto_profil')) {
                $gambar = $request->file('foto_profil');
                $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
                $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();

                // Pindahkan gambar ke direktori yang diinginkan
                $gambar->move('uploads/anak/', $new_gambar);

                // Update path gambar pada entitas anak yang ada
                $anak->foto_profil = 'uploads/anak/' . $new_gambar;
                $anak->save();
            }

            return redirect()->route('direktur.anak.index')->with('success', 'Data anak berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anak = Anak::with('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhanDisabilitas', 'penyakit', 'lokasiTugas')->find($id);
        $penyakit = $anak->penyakit;

        return view('direktur.DataAnak.Anak.show', compact('anak', 'penyakit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agama = Agama::all();
        $jenisKelamin = JenisKelamin::all();
        $golonganDarah = GolonganDarah::all();
        $kebutuhanDisabilitas = KebutuhanDisabilitas::all();
        $penyakit = Penyakit::all();
        $anak = Anak::find($id);
        $lokasiTugas = LokasiTugas::all();

        // Periksa apakah data anak ditemukan
        if (!$anak) {
            return redirect()->route('direktur.anak.index')->with('error', 'Data anak tidak ditemukan.');
        }

        return view('direktur.DataAnak.Anak.edit', compact('anak', 'agama', 'jenisKelamin', 'golonganDarah', 'kebutuhanDisabilitas', 'penyakit', 'lokasiTugas'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'nullable|string',
            'agama_id' => 'nullable',
            'jenis_kelamin_id' => 'nullable',
            'golongan_darah_id' => 'nullable',
            'kebutuhan_disabilitas_id' => 'nullable',
            'penyakit_id' => 'nullable',
            'lokasi_id' => 'nullable',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'disukai' => 'nullable|string',
            'tidak_disukai' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kelebihan' => 'nullable|string',
            'kekurangan' => 'nullable|string',
            'tipe_anak' => 'nullable|in:disabilitas,non_disabilitas'
        ]);
        $anak = Anak::find($id);

        if (!$anak) {
            return redirect()->route('direktur.anak.index')->with('error', 'Data anak tidak ditemukan.');
        }


        $data = $request->except('_token', '_method', 'foto_profil');


        if ($request->hasFile('foto_profil')) {
            $gambar = $request->file('foto_profil');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();

            $gambar->move('uploads/anak', $new_gambar);

            if ($anak->foto_profil) {
                if (file_exists(public_path($anak->foto_profil))) {
                    unlink(public_path($anak->foto_profil));
                }
            }

            $data['foto_profil'] = 'uploads/anak/' . $new_gambar;
        }

        $data['user_id'] = Auth::id(); // Assign logged in user ID
        $anak->update($data);
        return redirect()->route('direktur.anak.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anak = Anak::find($id);
        if ($anak) {
            if ($anak->foto_profil) {
                if (file_exists(public_path($anak->foto_profil))) {
                    unlink(public_path($anak->foto_profil));
                }
            }

            $anak->delete();
            return redirect()->route('direktur.anak.index')->with('success', 'Data anak berhasil dihapus.');
        } else {
            return redirect()->route('direktur.anak.index')->with('error', 'Anak tidak ditemukan.');
        }
    }

    public function nonaktifkan(string $id)
    {
        $anak = Anak::find($id);
        if ($anak) {
            $anak->tanggal_keluar = now();
            $anak->status = 'nonaktif';
            $anak->save();

            return redirect()->route('direktur.anak.index')->with('success', 'Anak berhasil dinonaktifkan.');
        } else {
            return redirect()->route('direktur.anak.index')->with('error', 'Anak tidak ditemukan.');
        }
    }

    public function aktifkan(string $id)
    {
        $anak = Anak::find($id);
        if ($anak) {
            $anak->tanggal_keluar = null;
            $anak->status = 'aktif';
            $anak->save();

            return redirect()->route('direktur.anak.index')->with('success', 'Anak berhasil diaktifkan kembali.');
        } else {
            return redirect()->route('direktur.anak.index')->with('error', 'Anak tidak ditemukan.');
        }
    }

    public function generatePDF($id)
    {
        $anak = Anak::findOrFail($id);

        // Load view content into a variable
        $pdfView = view('direktur.DataAnak.anak.pdf', compact('anak'))->render();

        // Setup Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Instantiate Dompdf with options
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($pdfView);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Create stream context to disable SSL verification
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ]);

        // Set stream context for Dompdf
        $dompdf->setHttpContext($context);

        // Render PDF (optional: save to file)
        $dompdf->render();

        // Get child's name for PDF filename
        $filename = 'anak_profile_' . str_replace(' ', '_', $anak->nama_lengkap) . '.pdf';

        // Output PDF to browser
        return $dompdf->stream($filename);
    }

    public function exportExcel()
    {
        return Excel::download(new ExportAnak, 'anak.xlsx');
    }
}
