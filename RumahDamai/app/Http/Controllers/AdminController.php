<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Middleware dan fungsi-fungsi lain yang mungkin diperlukan

    /**
     * Menambahkan pengguna baru (hanya dapat diakses oleh admin).
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth'); // Menerapkan middleware auth untuk memastikan pengguna masuk sebelum mengakses fungsi-fungsi ini
    }
    public function createUser(Request $request)
    {
        if (Auth::user()->type === 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users|max:255',
                'password' => 'required|string|min:8',
                'type' => 'required|in:0,1,2', // Sesuaikan dengan nomor tipe yang diizinkan
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'type' => $request->input('type'),
            ]);

            return redirect()->back()->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
