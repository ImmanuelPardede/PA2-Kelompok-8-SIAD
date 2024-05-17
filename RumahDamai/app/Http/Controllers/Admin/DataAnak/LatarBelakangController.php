<?php

namespace App\Http\Controllers\Admin\DataAnak;

use App\Models\Anak;
use App\Models\GambarLatarBelakang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LatarBelakang;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;


class LatarBelakangController extends Controller
{
    public function index()
    {
        $latarBelakangList = LatarBelakang::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.DataAnak.latarBelakang.index', compact('latarBelakangList'));
    }

    public function create()
    {
        $anak = Anak::all();
        return view('admin.DataAnak.latarBelakang.create', compact('anak'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anak_id' => 'required|exists:anak,id',
            'usia' => 'required|numeric',
            'kelas' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d',
            'deskripsi.*' => 'required|string',
            'gambar_latar_belakang.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $latarBelakang = new LatarBelakang();
        $latarBelakang->anak_id = $request->anak_id;
        $latarBelakang->usia = $request->usia;
        $latarBelakang->kelas = $request->kelas;
        $latarBelakang->tanggal = $request->tanggal;
        $latarBelakang->deskripsi = json_encode($request->deskripsi);
        $latarBelakang->save();

        // Handle Gambar Upload
        if ($request->hasFile('gambar_latar_belakang')) {
            foreach ($request->file('gambar_latar_belakang') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = 'uploads/gambar_latar_belakang/';
                $image->move($path, $filename);

                $gambarLatarBelakang = new GambarLatarBelakang();
                $gambarLatarBelakang->nama = $filename;
                $gambarLatarBelakang->latar_belakang_id = $latarBelakang->id;
                $gambarLatarBelakang->save();
            }
        }

        return redirect()->route('latarBelakang.index')->with('success', 'Latar belakang berhasil disimpan.');
    }


    public function show($id)
    {
        $latarBelakang = LatarBelakang::with('gambarLatarBelakang')->findOrFail($id);
        return view('admin.DataAnak.latarBelakang.show', compact('latarBelakang'));
    }


    public function edit($id)
    {
        $latarBelakang = LatarBelakang::findOrFail($id);
        $anak = Anak::all(); // Mengambil semua data anak untuk dipilih dalam form edit
        return view('admin.DataAnak.latarBelakang.edit', compact('latarBelakang', 'anak'));
    }

    public function update(Request $request, $id)
    {
        $item = LatarBelakang::findOrFail($id);

        $request->validate([
            'anak_id' => 'required|integer|exists:anak,id',
            'usia' => 'required|integer',
            'kelas' => 'required|string',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'gambar_latar_belakang' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the fields individually
        $item->anak_id = $request->anak_id;
        $item->usia = $request->usia;
        $item->kelas = $request->kelas;
        $item->tanggal = $request->tanggal;
        $item->deskripsi = $request->deskripsi;

        $item->deskripsi = json_encode($request->deskripsi);

        // Handle Gambar Upload
        if ($request->hasFile('gambar_latar_belakang')) {
            // Hapus gambar lama jika ada
            if ($item->gambarLatarBelakang->count() > 0) {
                foreach ($item->gambarLatarBelakang as $gambar) {
                    $gambar->delete();
                }
            }

            // Upload gambar baru
            $image = $request->file('gambar_latar_belakang');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'uploads/gambar_latar_belakang/';
            $image->move($path, $filename);

            $gambarLatarBelakang = new GambarLatarBelakang();
            $gambarLatarBelakang->nama = $filename;
            $gambarLatarBelakang->latar_belakang_id = $item->id;
            $gambarLatarBelakang->save();
        }

        $item->save(); // Simpan perubahan pada item

        return redirect()->route('latarBelakang.index')->with('success', 'Latar belakang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = LatarBelakang::findOrFail($id);
        $item->delete();

        return redirect()->route('latarBelakang.index')
            ->with('success', 'Product deleted successfully');
    }
}
