<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


    public function adminHome()
    {
        return view('admin.index');
    }

    public function guruHome()
    {
        return view('guruHome');
    }

    public function staffHome()
    {
        return view('staffHome');
    }
}
