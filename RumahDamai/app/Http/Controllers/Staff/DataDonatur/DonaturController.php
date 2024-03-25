<?php

namespace App\Http\Controllers\Staff\DataDonatur;

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
            'donasi_id' => 'nullable|array',
            'donasi_id.*' => 'exists:donasi,id',
            'nama_donatur' => 'nullable|string',
            'email_donatur' => 'nullable|string',
            'no_hp_donatur' => 'nullable|string',
            'jumlah_donasi' => 'nullable|numeric',
            'foto_donatur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses upload foto_donatur
        if ($request->hasFile('foto_donatur')) {
            $gambar = $request->file('foto_donatur');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();

            $gambar->move('uploads/donatur/', $new_gambar);

            $validatedData['foto_donatur'] = 'uploads/donatur/' . $new_gambar;
        }

        $donatur = new Donatur([
            'nama_donatur' => $validatedData['nama_donatur'],
            'email_donatur' => $validatedData['email_donatur'],
            'no_hp_donatur' => $validatedData['no_hp_donatur'],
            'jumlah_donasi' => $validatedData['jumlah_donasi'],
            'foto_donatur' => $validatedData['foto_donatur'],
        ]);
        $donatur->save();

        // Menyimpan relasi dengan donasi
        if (isset($validatedData['donasi_id'])) {
            $donatur->donasi()->attach($validatedData['donasi_id']);
        }

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
            'donasi_id' => 'nullable|array',
            'donasi_id.*' => 'exists:donasi,id',
            'nama_donatur' => 'nullable|string',
            'email_donatur' => 'nullable|string',
            'no_hp_donatur' => 'nullable|string',
            'jumlah_donasi' => 'nullable|numeric',
            'foto_donatur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $donatur = Donatur::find($id);

        if ($request->hasFile('foto_donatur')) {
            $gambar = $request->file('foto_donatur');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();

            $gambar->move('uploads/donatur/', $new_gambar);

            $validatedData['foto_donatur'] = 'uploads/donatur/' . $new_gambar;

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
