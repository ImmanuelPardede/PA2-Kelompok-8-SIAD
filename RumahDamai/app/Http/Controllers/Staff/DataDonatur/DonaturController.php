<?php

namespace App\Http\Controllers\Staff\DataDonatur;

use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DonaturController extends Controller
{
    public function index()
    {
        $donaturList = Donatur::orderBy('created_at', 'desc')->paginate(7);
        return view('staff.DataDonatur.index', compact('donaturList'));
    }

    public function create()
    {
        $donasi = Donasi::all();
        $loggedInUserId = Auth::id();
        return view('staff.DataDonatur.create', compact('donasi'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'donasi_id' => 'required|array',
            'donasi_id.*' => 'exists:donasi,id',
            'nama_donatur' => 'required|string',
            'email_donatur' => 'required|string',
            'tanggal_donatur' => 'required|date',
            'no_hp_donatur' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'jumlah_donasi' => 'nullable|numeric',
            'foto_donatur' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validatedData['user_id'] = Auth::id();

        if (!isset($validatedData['jumlah_donasi'])) {
            $validatedData['jumlah_donasi'] = 0; // Default value
        }

        if ($request->hasFile('foto_donatur')) {
            $gambar = $request->file('foto_donatur');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads/donatur/', $new_gambar);
            $validatedData['foto_donatur'] = 'uploads/donatur/' . $new_gambar;
        }

        $donatur = Donatur::create($validatedData);

        if (isset($validatedData['donasi_id'])) {
            $donatur->donasi()->attach($validatedData['donasi_id']);
        }

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil ditambahkan.');
    }

    public function show($id)
    {
        $donatur = Donatur::with('donasi')->find($id);
        return view('staff.DataDonatur.show', compact('donatur'));
    }

    public function edit($id)
    {
        $donasi = Donasi::all();
        $donatur = Donatur::find($id);
        return view('staff.DataDonatur.edit', compact('donasi', 'donatur'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'donasi_id' => 'nullable|array',
            'donasi_id.*' => 'exists:donasi,id',
            'nama_donatur' => 'nullable|string',
            'email_donatur' => 'nullable|string',
            'tanggal_donatur' => 'nullable|date',
            'no_hp_donatur' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'jumlah_donasi' => 'nullable|numeric',
            'foto_donatur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validatedData['user_id'] = Auth::id();

        if (!isset($validatedData['jumlah_donasi'])) {
            $validatedData['jumlah_donasi'] = 0; // Default value
        }

        $donatur = Donatur::findOrFail($id);

        if ($request->hasFile('foto_donatur')) {
            $gambar = $request->file('foto_donatur');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads/donatur/', $new_gambar);
            if ($donatur->foto_donatur) {
                unlink(public_path($donatur->foto_donatur));
            }
            $validatedData['foto_donatur'] = 'uploads/donatur/' . $new_gambar;
        }

        $donatur->update($validatedData);

        if (isset($validatedData['donasi_id'])) {
            $donatur->donasi()->sync($validatedData['donasi_id']);
        } else {
            $donatur->donasi()->detach();
        }

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $donatur = Donatur::findOrFail($id);

        if ($donatur->foto_donatur) {
            Storage::delete($donatur->foto_donatur);
        }

        $donatur->donasi()->detach();
        $donatur->delete();

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil dihapus.');
    }
}
