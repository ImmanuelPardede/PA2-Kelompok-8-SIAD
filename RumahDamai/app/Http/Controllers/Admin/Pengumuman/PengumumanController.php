<?php

namespace App\Http\Controllers\Admin\Pengumuman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;



class PengumumanController extends Controller
{
    public function index()
    {
        // Mengambil semua pengumuman dari model Pengumuman
        $pengumumans = Pengumuman::all();
        
        // Mengirimkan data pengumuman ke view 'dashboard'
        return view('dashboard', compact('pengumumans'));
    }

    public function create()
    {
        // Hanya admin yang boleh membuat pengumuman
        if (Auth::user()->role == 'admin') {
            return view('admin.pengumuman.create');
        } else {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk membuat pengumuman.');
        }
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);

        // Hanya admin yang boleh membuat pengumuman
        if (Auth::user()->role == 'admin') {
            Pengumuman::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('dashboard')->with('success', 'Pengumuman berhasil ditambahkan.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk membuat pengumuman.');
        }
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);

        $pengumuman->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('dashboard')->with('success', 'Pengumuman berhasil dihapus.');
    }



}
