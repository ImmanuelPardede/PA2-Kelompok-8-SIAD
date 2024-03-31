<?php

namespace App\Http\Controllers\Guru\Materi;

use App\Models\Kelas;
use App\Models\ModulMateri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModulMateriController extends Controller
{
    public function index()
    {
        $modulMateriList = ModulMateri::orderBy('created_at', 'desc')->paginate(7);
        return view('guru.materi.modulMateri.index', compact('modulMateriList'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('guru.materi.modulMateri.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama_materi' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        ModulMateri::create($request->all());

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil ditambahkan.');
    }



    public function show(string $id)
    {
        $modulMateri = ModulMateri::with('kelas')->find($id); // Mengubah 'anak' menjadi 'kelas'
        return view('guru.materi.modulMateri.show', compact('modulMateri'));
    }

    public function edit(string $id)
    {
        $modulMateri = ModulMateri::find($id);
        $kelas = Kelas::all(); // Mengambil data kelas untuk dropdown

        return view('guru.materi.modulMateri.edit', compact('modulMateri', 'kelas'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_materi' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $modulMateri = ModulMateri::find($id); // Mengubah $modulmateri menjadi $modulMateri
        $modulMateri->update($request->all());

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $modulMateri = ModulMateri::find($id); // Mengubah $modulmateri menjadi $modulMateri
        $modulMateri->delete();

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil dihapus.');
    }
}
