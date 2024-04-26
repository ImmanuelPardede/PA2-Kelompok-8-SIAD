<?php

namespace App\Http\Controllers\Admin\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::all(); // Mengambil satu data Foundationabouts terbaru
    
        // Kembalikan view 'berita.show' dengan data beritaItem yang ditemukan
        return view('admin.visitor.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriBerita::all();
        return view('admin.visitor.berita.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'img_berita' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);
    
    
         // Mengelola upload foto profil
         if ($request->hasFile('img_berita')) {
            $gambar = $request->file('img_berita');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();
    
            // Pindahkan gambar ke direktori yang diinginkan (storage/app/public/uploads/berita/)
            $gambar->move('uploads/visitor/berita/', $new_gambar);
    
            // Buat instance beritaItem dengan data yang disediakan
            $berita = new Berita([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori_id' => $request->kategori_id,
                'img_berita' => 'uploads/visitor/berita/' . $new_gambar, // Set nilai img_berita
            ]);
    
            // Simpan instance beritaItem ke dalam database
            $berita->save();
    
            return redirect()->route('berita.index')
                             ->with('success', 'berita item created successfully.');
        }
    
        // Jika tidak ada file yang diunggah, tampilkan pesan error
        return redirect()->route('berita.create')
                         ->with('error', 'Failed to upload image.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Temukan berita berdasarkan ID
        $berita = Berita::findOrFail($id);
    
        // Ambil daftar kategori berita
        $kategori = KategoriBerita::all();
    
        // Tampilkan halaman edit berita dengan data yang ditemukan
        return view('admin.visitor.berita.edit', compact('berita', 'kategori'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);
    
        // Temukan berita berdasarkan ID
        $berita = Berita::findOrFail($id);
    
        // Perbarui data berita sesuai dengan data yang dikirimkan
        $berita->kategori_id = $request->kategori_id;
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
    
        // Mengelola update gambar berita
        if ($request->hasFile('img_berita')) {
            $gambar = $request->file('img_berita');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();
    
            // Pindahkan gambar ke direktori yang diinginkan (storage/app/public/uploads/berita/)
            $gambar->move('uploads/visitor/berita/', $new_gambar);
    
            // Hapus gambar lama jika ada
            if (file_exists(public_path($berita->img_berita))) {
                unlink(public_path($berita->img_berita));
            }
    
            // Set gambar baru ke dalam atribut img_berita
            $berita->img_berita = 'uploads/visitor/berita/' . $new_gambar;
        }
    
        // Simpan perubahan pada berita
        $berita->save();
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('berita.index')
                         ->with('success', 'Berita item updated successfully.');
    }
    

    public function destroy($id)
    {
        // Temukan CarouselItem berdasarkan ID
        $berita = Berita::findOrFail($id);
    
        if ($berita->img_berita) {
            if (file_exists(public_path($berita->img_berita))) {
                unlink(public_path($berita->img_berita));
        }
        $berita->delete();
    
        return redirect()->route('berita.index')->with('success', 'Carousel item deleted successfully.');
    }
    
    
    }
}
