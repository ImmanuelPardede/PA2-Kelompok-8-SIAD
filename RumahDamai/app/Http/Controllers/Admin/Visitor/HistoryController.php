<?php

namespace App\Http\Controllers\Admin\Visitor;

use App\Http\Controllers\Controller;
use App\Models\FoundationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $history = FoundationHistory::latest()->first(); // Mengambil satu data FoundationHistory terbaru
    
        // Kembalikan view 'carousel.show' dengan data CarouselItem yang ditemukan
        return view('admin.visitor.history.index', compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Visitor.history.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input form
    $validatedData = $request->validate([
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'sejarah_singkat' => 'required|string',
        'tujuan_utama' => 'required|string',
        'dibangun' => 'required|date',
    ]);

    // Proses penyimpanan gambar
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
        $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();

        // Pindahkan gambar ke direktori yang diinginkan
        $gambar->move('uploads/visitor/history/', $new_gambar);
    }

    // Buat instance FoundationHistory dengan data yang disediakan
    $foundationHistory = new FoundationHistory();
    $foundationHistory->gambar = 'uploads/visitor/history/' . $new_gambar;
    $foundationHistory->sejarah_singkat = $validatedData['sejarah_singkat'];
    $foundationHistory->tujuan_utama = $validatedData['tujuan_utama'];
    $foundationHistory->dibangun = $validatedData['dibangun'];

    // Simpan instance FoundationHistory ke dalam database
    $foundationHistory->save();

    // Redirect dengan flash message sukses
    return redirect()->route('history.index')->with('success', 'Foundation history has been added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $history = FoundationHistory::find($id);

        return view('admin.visitor.history.show', compact('history'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $history = FoundationHistory::find($id);

        return view('admin.visitor.history.edit', compact('history'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Hanya terima file gambar dengan ekstensi tertentu (jpeg, png, jpg, gif) dan maksimal ukuran 2MB
            'sejarah_singkat' => 'required|string',
            'tujuan_utama' => 'required|string',
            'dibangun' => 'required|date',
        ]);
    
        $history = FoundationHistory::find($id);
    

    
        // Update gambar jika ada perubahan
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();
            
            $gambar->move('uploads/visitor/history/', $new_gambar);

            if ($history->gambar){
                if (file_exists(public_path($history->gambar))) {
                    unlink(public_path($history->gambar));
                }
            }

            $history->gambar = 'uploads/visitor/history/' . $new_gambar;

        }
                // Proses update data
                $history->sejarah_singkat = $request->sejarah_singkat;
                $history->tujuan_utama = $request->tujuan_utama;
                $history->dibangun = $request->dibangun;
    
        $history->save();
    
        return redirect()->route('history.index')->with('success', 'Foundation history updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan CarouselItem berdasarkan ID
        $history = FoundationHistory::find($id);
    
        if ($history->gambar) {
            if (file_exists(public_path($history->gambar))) {
                unlink(public_path($history->gambar));
        }
        // Hapus history dari database
        $history->delete();
    
        return redirect()->route('history.index')
                         ->with('success', 'Carousel item deleted successfully.');

    }


        
}



}
