<?php

namespace App\Http\Controllers\Pengumuman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class MenampilkanPengumumanController extends Controller
{
    public function index(Request $request)
    {
        // Get paginated announcements sorted by date (10 per page)
        $query = $request->input('search');
        $pengumumans = Pengumuman::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('judul', 'like', "%{$query}%")
                ->orWhere('kategori', 'like', "%{$query}%");
        })->paginate(10);

        if ($request->ajax()) {
            return view('pengumuman._table', compact('pengumumans'))->render();
        }


        // Return the view for displaying announcements
        return view('pengumuman.index', compact('pengumumans'));
    }
}
