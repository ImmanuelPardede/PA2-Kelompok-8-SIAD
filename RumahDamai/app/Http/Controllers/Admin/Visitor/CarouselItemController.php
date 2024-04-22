<?php

namespace App\Http\Controllers\Admin\Visitor;

use App\Http\Controllers\Controller;
use App\Models\CarouselItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CarouselItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carouselItems = CarouselItem::all();
        return view('admin.Visitor.carousel.index', compact('carouselItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Visitor.carousel.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
            'caption' => 'nullable|string',
            'subcaption' => 'nullable|string',
        ]);
    
        // Mengelola upload foto profil
        if ($request->hasFile('image_url')) {
            $gambar = $request->file('image_url');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();
    
            // Pindahkan gambar ke direktori yang diinginkan (storage/app/public/uploads/carousel/)
            $gambar->move('uploads/visitor/carousel/', $new_gambar);
    
            // Buat instance CarouselItem dengan data yang disediakan
            $carousel = new CarouselItem([
                'caption' => $request->caption,
                'subcaption' => $request->subcaption,
                'image_url' => 'uploads/visitor/carousel/' . $new_gambar, // Set nilai image_url
            ]);
    
            // Simpan instance CarouselItem ke dalam database
            $carousel->save();
    
            return redirect()->route('carousel.index')
                             ->with('success', 'Carousel item created successfully.');
        }
    
        // Jika tidak ada file yang diunggah, tampilkan pesan error
        return redirect()->route('carousel.create')
                         ->with('error', 'Failed to upload image.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Temukan CarouselItem berdasarkan ID
        $carouselItem = CarouselItem::findOrFail($id);
    
        // Kembalikan view 'carousel.show' dengan data CarouselItem yang ditemukan
        return view('admin.visitor.carousel.show', compact('carouselItem'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Temukan CarouselItem berdasarkan ID
        $carousel = CarouselItem::findOrFail($id);
    
        // Kembalikan view edit dengan data CarouselItem yang ditemukan
        return view('admin.Visitor.carousel.edit', compact('carousel'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'caption' => 'nullable|string',
        'subcaption' => 'nullable|string',
    ]);

    $carousel = CarouselItem::findOrFail($id);

    // Tangani penghapusan gambar lama jika ada gambar baru yang diunggah
    if ($request->hasFile('image_url')) {
        $gambar = $request->file('image_url');
        $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
        $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();

        // Pindahkan gambar baru ke direktori yang diinginkan
        $gambar->move('uploads/visitor/carousel/', $new_gambar);

        // Hapus gambar lama jika ada
        if ($carousel->image_url){
            if (file_exists(public_path($carousel->image_url))) {
                unlink(public_path($carousel->image_url));
            }
        }

        // Simpan path gambar baru ke dalam database
        $carousel->image_url = 'uploads/visitor/carousel/' . $new_gambar;
    }

    // Update caption dan subcaption
    $carousel->caption = $request->caption;
    $carousel->subcaption = $request->subcaption;

    // Simpan perubahan ke dalam database
    $carousel->save();

    return redirect()->route('carousel.index')->with('success', 'Carousel item updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan CarouselItem berdasarkan ID
        $carouselItem = CarouselItem::findOrFail($id);
    
        if ($carouselItem->image_url) {
            if (file_exists(public_path($carouselItem->image_url))) {
                unlink(public_path($carouselItem->image_url));
        }
        // Hapus CarouselItem dari database
        $carouselItem->delete();
    
        return redirect()->route('carousel.index')
                         ->with('success', 'Carousel item deleted successfully.');
    }
    
    
    }
}