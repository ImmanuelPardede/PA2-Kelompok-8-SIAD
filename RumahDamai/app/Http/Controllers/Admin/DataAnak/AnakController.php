<?php

namespace App\Http\Controllers\Admin\DataAnak;

use App\Http\Controllers\Controller;
use App\Models\KebutuhanDisabilitas;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\Penyakit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AnakController extends Controller
{

    public function index()
    {
        $anakList = Anak::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.DataAnak.Anak.index', compact('anakList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agama = Agama::all();
        $jenisKelamin = JenisKelamin::all();
        $golonganDarah = GolonganDarah::all();
        $kebutuhanDisabilitas = KebutuhanDisabilitas::all();
        $penyakit = Penyakit::all();
        return view('admin.DataAnak.Anak.create', compact('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhanDisabilitas', 'penyakit'));
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
            'jenis_kelamin_id' => 'required',
            'golongan_darah_id' => 'required',
            'kebutuhan_disabilitas_id' => 'nullable',
            'penyakit_id' => 'nullable',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'disukai' => 'nullable|string',
            'tidak_disukai' => 'nullable|string',
            'alamat' => 'required|string',
            'kelebihan' => 'nullable|string',
            'kekurangan' => 'nullable|string',

        ]);

        $data = $request->except('_token');
        $data['status'] = 'aktif';
        $data['tanggal_masuk'] = now();


        if ($request->hasFile('foto_profil')) {
            $gambar = $request->file('foto_profil');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME)); // Getting file name without extension
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension(); // Appending extension to file name

            // Pindahkan gambar ke direktori yang diinginkan
            $gambar->move('uploads/anak/', $new_gambar);

            // Update path gambar pada entitas anak yang ada
            $data['foto_profil'] = 'uploads/anak/' . $new_gambar; // Updating $data array with new image path
        }

        if ($request->has('kebutuhan_disabilitas_id')) {
            $data['kebutuhan_disabilitas_id'] = $request->kebutuhan_disabilitas_id;
        }
        

        // Membuat data anak baru di database
        Anak::create($data);

        return redirect()->route('anak.index')->with('success', 'Data anak berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anak = Anak::with('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhanDisabilitas', 'penyakit')->find($id);
        $penyakit = $anak->penyakit;

        return view('admin.DataAnak.Anak.show', compact('anak', 'penyakit'));
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
        return view('admin.DataAnak.Anak.edit', compact('anak', 'agama', 'jenisKelamin', 'golonganDarah', 'kebutuhanDisabilitas', 'penyakit'));
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
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'disukai' => 'nullable|string',
            'tidak_disukai' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kelebihan' => 'nullable|string',
            'kekurangan' => 'nullable|string',
        ]);

        $anak = Anak::find($id);
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

        $anak->update($data);

        return redirect()->route('anak.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus anak berdasarkan ID
        $anak = Anak::find($id);
        if ($anak) {
            // Hapus foto profil jika ada
            if ($anak->foto_profil) {
                // Pastikan file ada sebelum menghapus
                if (file_exists(public_path($anak->foto_profil))) {
                    unlink(public_path($anak->foto_profil)); // Hapus file gambar
                }
            }

            $anak->delete();
            return redirect()->route('anak.index')->with('success', 'Data anak berhasil dihapus.');
        } else {
            return redirect()->route('anak.index')->with('error', 'Anak tidak ditemukan.');
        }
    }


    public function nonaktifkan(string $id)
    {
        $anak = Anak::find($id);
        if ($anak) {
            // Mengisi tanggal_keluar dengan tanggal saat ini
            $anak->tanggal_keluar = now();
            $anak->status = 'nonaktif';
            $anak->save();

            return redirect()->route('anak.index')->with('success', 'Anak berhasil dinonaktifkan.');
        } else {
            return redirect()->route('anak.index')->with('error', 'Anak tidak ditemukan.');
        }
    }

    public function aktifkan(string $id)
    {
        $anak = Anak::find($id);
        if ($anak) {
            $anak->tanggal_keluar = null; // Menghapus tanggal_keluar
            $anak->status = 'aktif';
            $anak->save();

            return redirect()->route('anak.index')->with('success', 'Anak berhasil diaktifkan kembali.');
        } else {
            return redirect()->route('anak.index')->with('error', 'Anak tidak ditemukan.');
        }
    }
}
