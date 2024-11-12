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
    public function index(Request $request)
    {
        $currentYear = now()->year;
        $selectedYear = $request->input('tanggal_donatur') ?: $currentYear;

        $donaturList = Donatur::when($selectedYear, function ($query, $selectedYear) {
            return $query->whereYear('tanggal_donatur', $selectedYear);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(7)
        ->appends(['tanggal_donatur' => $selectedYear]); // Menjaga filter saat pagination

    // Mengambil tahun yang unik saja dari kolom 'tanggal_sponsor'
    $tanggalDonaturList = Donatur::selectRaw('YEAR(tanggal_donatur) as tahun')
        ->groupBy('tahun')
        ->orderBy('tahun', 'desc')
        ->get();

        return view('staff.DataDonatur.index', compact('donaturList', 'tanggalDonaturList', 'selectedYear'));
    }

    public function create()
    {
        $donasi = Donasi::all();
        return view('staff.DataDonatur.create', compact('donasi'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email_donatur' => 'required|email|unique:donatur,email_donatur|max:255',
            'tanggal_donatur' => 'required|date',
            'no_hp_donatur' => 'nullable|string|max:20',
            'deskripsi' => 'nullable|string|max:500',
            'jumlah_donasi' => 'nullable|numeric',
            'foto_donatur' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'lainnya' => 'nullable|string|max:255',
        ]);

        $donasi_ids = $request->input('donasi_id', []);

        foreach ($donasi_ids as $donasi_id) {
            if ($donasi_id !== 'lainnya' && !Donasi::find($donasi_id)) {
                return redirect()->back()->withErrors(['donasi_id' => 'The selected donasi_id is invalid.']);
            }
        }

        $validatedData['user_id'] = Auth::id();
        $validatedData['jumlah_donasi'] = $validatedData['jumlah_donasi'] ?? 0;

        if ($request->hasFile('foto_donatur')) {
            $gambar = $request->file('foto_donatur');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/donatur'), $new_gambar);
            $validatedData['foto_donatur'] = 'uploads/donatur/' . $new_gambar;
        }

        if (!empty($validatedData['lainnya'])) {
            $validatedData['lainnya'] = $request->input('lainnya');
        }

        $donatur = Donatur::create($validatedData);
        $donatur->donasi()->attach(array_filter($donasi_ids, fn ($id) => $id !== 'lainnya'));

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil ditambahkan.');
    }

    public function show($id)
    {
        $donatur = Donatur::with('donasi')->find($id);
        return view('staff.DataDonatur.show', compact('donatur'));
    }

    public function edit($id)
    {
        $donatur = Donatur::with('donasi')->find($id);
        $donasi = Donasi::all();
        $selectedDonasiIds = $donatur->donasi->pluck('id')->toArray();
        if ($donatur->lainnya) {
            $selectedDonasiIds[] = 'lainnya';
        }
        return view('staff.DataDonatur.edit', compact('donatur', 'donasi', 'selectedDonasiIds'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email_donatur' => 'required|email|max:255',
            'tanggal_donatur' => 'required|date',
            'foto_donatur' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'donasi_id' => 'required|array',
            'jumlah_donasi' => 'nullable|numeric',
            'lainnya' => 'nullable|string|max:255',
        ]);

        $donatur = Donatur::find($id);

        // Update the donatur fields
        $donatur->nama_donatur = $request->nama_donatur;
        $donatur->email_donatur = $request->email_donatur;
        $donatur->tanggal_donatur = $request->tanggal_donatur;
        $donatur->no_hp_donatur = $request->no_hp_donatur;
        $donatur->deskripsi = $request->deskripsi;
        $donatur->jumlah_donasi = $request->jumlah_donasi;

        // Handle file upload
        if ($request->hasFile('foto_donatur')) {
            // Delete the old photo if it exists
            if ($donatur->foto_donatur && file_exists(public_path($donatur->foto_donatur))) {
                unlink(public_path($donatur->foto_donatur));
            }

            $file = $request->file('foto_donatur');
            $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $newFileName = time() . '_' . $slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/donatur'), $newFileName);
            $donatur->foto_donatur = 'uploads/donatur/' . $newFileName;
        }

        // Handle 'lainnya'
        if (in_array('lainnya', $request->donasi_id)) {
            $donatur->lainnya = $request->lainnya;
        } else {
            $donatur->lainnya = null; // Clear the 'lainnya' field if not selected
        }

        $donatur->save();

        // Update the pivot table for donasi_id
        $donatur->donasi()->sync(array_diff($request->donasi_id, ['lainnya']));

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $donatur = Donatur::findOrFail($id);

        if ($donatur->foto_donatur && file_exists(public_path($donatur->foto_donatur))) {
            unlink(public_path($donatur->foto_donatur));
        }

        $donatur->donasi()->detach();
        $donatur->delete();

        return redirect()->route('dataDonatur.index')->with('success', 'Data Donatur berhasil dihapus.');
    }
}
