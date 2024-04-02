<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Anak;
use App\Models\TodoList;
use App\Models\LokasiTugas;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        public function dashboard()
        {
            $pengumumans = Pengumuman::orderBy('created_at', 'desc')->get();
            $totalPegawai = User::count();
            $totalanak = Anak::count();
            $todolist = TodoList::all();
            
            return view('dashboard', compact('totalPegawai', 'pengumumans', 'totalanak', 'todolist'));
        }
    


     public function adminHome()
     {
         $totalPegawai = User::count();
         return view('admin.index', compact('totalPegawai'));
     }

     public function guruHome()
     {
         $totalPegawai = User::count();
         return view('guru.index', compact('totalPegawai'));
     }

     public function staffHome()
     {
         $totalPegawai = User::count();
         return view('staff.index', compact('totalPegawai'));
     }
}
