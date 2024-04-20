<?php

namespace App\Http\Controllers\visitor;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\CarouselItem;
use App\Models\FoundationHistory;
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
    
}
