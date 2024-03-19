<?php

namespace App\Http\Controllers\Admin\DataAnak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\Kebutuhan;
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
        $kebutuhan = Kebutuhan::all();
        $penyakit = Penyakit::all();
        return view('admin.DataAnak.Anak.create', compact('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhan', 'penyakit'));
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
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adding image validation rules
        ]);
    
        // Menyimpan data kecuali token
        $data = $request->except('_token');
    
        if ($request->hasFile('foto_profil')) {
            $gambar = $request->file('foto_profil');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME)); // Getting file name without extension
            $new_gambar = time() .'_'. $slug .'.'. $gambar->getClientOriginalExtension(); // Appending extension to file name
    
            // Pindahkan gambar ke direktori yang diinginkan
            $gambar->move('uploads/anak/', $new_gambar);
    
            // Update path gambar pada entitas anak yang ada
            $data['foto_profil'] = 'uploads/anak/' . $new_gambar; // Updating $data array with new image path
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
        $anak = Anak::with('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhan', 'penyakit')->find($id);
        return view('admin.DataAnak.Anak.show', compact('anak'));
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
        return view('admin.DataAnak.Anak.edit', compact('anak', 'agama', 'jenisKelamin', 'golonganDarah', 'kebutuhan', 'penyakit'));
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
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);
    
        // Ambil anak yang ada berdasarkan ID
        $anak = Anak::find($id);
    
        // Update data lainnya kecuali foto profil
        $data = $request->except('_token', '_method', 'foto_profil');
    
        if ($request->hasFile('foto_profil')) {
            // Proses penyimpanan gambar baru
            $gambar = $request->file('foto_profil');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME)); // Dapatkan nama file tanpa ekstensi
            $new_gambar = time() .'_'. $slug .'.'. $gambar->getClientOriginalExtension(); // Tambahkan ekstensi ke nama file
    
            // Pindahkan gambar ke direktori yang diinginkan di storage Laravel
            $gambar->move('uploads/anak', $new_gambar);
    
            // Hapus gambar lama jika ada
            if ($anak->foto_profil) {
                // Pastikan file lama ada sebelum menghapus
                if (file_exists(public_path($anak->foto_profil))) {
                    unlink(public_path($anak->foto_profil)); // Hapus file lama
                }
            }
    
            // Update path gambar pada entitas anak yang ada
            $data['foto_profil'] = 'uploads/anak/' . $new_gambar;
        }
    
        // Lakukan update data anak
        $anak->update($data);
    
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
