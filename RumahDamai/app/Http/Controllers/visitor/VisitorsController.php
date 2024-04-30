<?php

namespace App\Http\Controllers\visitor;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Anak;
use App\Models\AnakDisabilitas;
use App\Models\AnakNonDisabilitas;
use App\Models\Berita;
use App\Models\CarouselItem;
use App\Models\DetailGaleri;
use App\Models\DetailProgram;
use App\Models\Fasilitas;
use App\Models\FoundationHistory;
use App\Models\Galeri;
use App\Models\KategoriBerita;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class VisitorsController extends Controller
{
    public function home()
    {
        $carousel = CarouselItem::all();
        $history = FoundationHistory::all();
        $totalAnak = Anak::count();
        $berita = Berita::all();
        $totalProgram = DetailProgram::count();
        $kategori = KategoriBerita::all();
        $anaktepi = AnakDisabilitas::count();
        $anakdisabilitas = AnakNonDisabilitas::count();
        return view('visitor.home', compact('carousel','history','totalAnak','berita','totalProgram','kategori','anaktepi','anakdisabilitas'));

    }

    public function aboutUs()
    {
        $abouts = About::all();
        return view('visitor.about', compact('abouts'));
    }

    public function programrm()
    {
        $programs = Program::all();
        $detailPrograms = DetailProgram::all();
        $totalProgram = DetailProgram::count();
        return view('visitor.program', compact('programs','detailPrograms','totalProgram'));
    }

    public function fasilitasi()
    {
        $fasilitas = Fasilitas::all();
        $detailfasilitas = Fasilitas::all();
        return view('visitor.fasilitas',compact('fasilitas','detailfasilitas'));
    }

    public function news()
    {
        $berita = Berita::all();
        $kategori = KategoriBerita::all();
        return view('visitor.berita', compact('berita','kategori'));
    }

    public function show($id)
    {
        // Mengambil data berita berdasarkan ID
        $berita = Berita::find($id);
        // Jika berita tidak ditemukan
        if (!$berita) {
            abort(404); // Mengembalikan response 404 Not Found
        }
        // Mengambil berita terbaru (kecuali berita utama yang sedang ditampilkan)
        $recentNews = Berita::all();
        $kategori = KategoriBerita::all();
        // Mengirim data berita dan recent news ke halaman detail berita
        return view('visitor.detailberita', compact('berita', 'recentNews','kategori'));
    }


    public function gallery()
    {
        $galeri = Galeri::all();
        $detailgaleriCounts = DetailGaleri::groupBy('galeri_id')->pluck(DB::raw('count(*) as total'), 'galeri_id');
        return view('visitor.galeri', compact('galeri','detailgaleriCounts'));
    }

    public function detailgallery($id)
    {
        $galeri = Galeri::find($id);
        $detailgaleriCounts = DetailGaleri::groupBy('galeri_id')->pluck(DB::raw('count(*) as total'), 'galeri_id');
        return view('visitor.detailgaleri', compact('galeri','detailgaleriCounts'));
    }




    public function contact()
    {
        return view('visitor.contact');
    }
}
