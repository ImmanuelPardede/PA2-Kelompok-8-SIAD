<?php

namespace App\Http\Controllers\visitor;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Anak;
use App\Models\CarouselItem;
use App\Models\DetailProgram;
use App\Models\FoundationHistory;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VisitorsController extends Controller
{
    public function home()
    {
        $carousel = CarouselItem::all();
        $history = FoundationHistory::all();
        $totalAnak = Anak::count(); 

        

        return view('visitor.home', compact('carousel','history','totalAnak'));

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
        return view('visitor.fasilitas');
    }
    
    public function news()
    {
        return view('visitor.berita');
    }

    public function gallery()
    {
        return view('visitor.galeri');
    }

    public function contact()
    {
        return view('visitor.contact');
    }
}
