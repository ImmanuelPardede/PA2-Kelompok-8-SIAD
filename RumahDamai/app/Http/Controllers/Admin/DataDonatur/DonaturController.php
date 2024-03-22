<?php

namespace App\Http\Controllers\Admin\DataDonatur;

use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Support\Str;

class DonaturController extends Controller
{
    public function index()
    {
        $donaturList = Donatur::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.DataDonatur.index', compact('donaturList'));
    }

    public function create()
    {
        $donasi = Donasi::all();
        return view('admin.DataDonatur.create', compact('donasi'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'donasi_id' => 'required',
            'nama_donatur' => 'nullable|string',
            'email_donatur' => 'nullable|string',
            'no_hp_donatur' => 'nullable|string',
            'jumlah_donasi' => 'nullable|numeric',
            'foto_donatur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Process foto_donatur upload
        if ($request->hasFile('foto_donatur')) {
            $gambar = $request->file('foto_donatur');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME)); // Getting file name without extension
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension(); // Appending extension to file name

            // Pindahkan gambar ke direktori yang diinginkan
            $gambar->move('uploads/donatur/', $new_gambar);

            // Update path gambar pada data yang akan disimpan
            $validatedData['foto_donatur'] = 'uploads/donatur/' . $new_gambar;
        }

        Donatur::create($validatedData);

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil ditambahkan.');
    }

    public function show($id)
    {
        $donatur = Donatur::with('donasi')->find($id);
        return view('admin.DataDonatur.show', compact('donatur'));
    }

    public function edit($id)
    {
        $donasi = Donasi::all();
        $donatur = Donatur::find($id);
        return view('admin.DataDonatur.edit', compact('donasi', 'donatur'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'donasi_id' => 'nullable',
            'nama_donatur' => 'nullable|string',
            'email_donatur' => 'nullable|string',
            'no_hp_donatur' => 'nullable|string',
            'jumlah_donasi' => 'nullable|numeric',
            'foto_donatur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $donatur = Donatur::find($id);

        // Process foto_donatur upload for update
        if ($request->hasFile('foto_donatur')) {
            $gambar = $request->file('foto_donatur');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME)); // Getting file name without extension
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension(); // Appending extension to file name

            // Pindahkan gambar ke direktori yang diinginkan
            $gambar->move('uploads/donatur/', $new_gambar);

            // Update path gambar pada data yang akan diupdate
            $validatedData['foto_donatur'] = 'uploads/donatur/' . $new_gambar;

            // Hapus foto lama jika ada
            if ($donatur->foto_donatur) {
                if (file_exists(public_path($donatur->foto_donatur))) {
                    unlink(public_path($donatur->foto_donatur));
                }
            }
        }

        $donatur->update($validatedData);

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $donatur = Donatur::find($id);
        $donatur->delete();

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil dihapus.');
    }
}
