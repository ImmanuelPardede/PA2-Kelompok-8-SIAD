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
        $tahun_kurikulum_id = null; // Inisialisasi variabel

        // Cek apakah ada kelas yang dipilih dalam request
        if (request()->has('kelas_id')) {
            $selectedKelasId = request()->input('kelas_id');
            $selectedKelas = Kelas::find($selectedKelasId);

            if ($selectedKelas) {
                $tahun_kurikulum_id = $selectedKelas->tahun_kurikulum_id;
            }
        }

        return view('guru.materi.modulMateri.create', compact('kelas', 'tahun_kurikulum_id'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama_materi' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        // Mendapatkan tahun ajaran dari kelas yang dipilih
        $kelas = Kelas::findOrFail($request->kelas_id);
        $tahun_kurikulum_id = $kelas->tahun_kurikulum_id;

        // Memasukkan nilai 'tahun_kurikulum_id' ke dalam input
        $input = $request->all();
        $input['tanggal_publish'] = now();
        $input['tahun_kurikulum_id'] = $tahun_kurikulum_id;

        // Simpan data ke dalam database
        ModulMateri::create($input);

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil ditambahkan.');
    }




    public function show(string $id)
    {
        $modulMateri = ModulMateri::with('kelas')->find($id); // Mengubah 'anak' menjadi 'kelas'
        return view('guru.materi.modulMateri.show', compact('modulMateri'));
    }

    public function edit(string $id)
    {
        $modulMateri = ModulMateri::findOrFail($id);
        $kelas = Kelas::all(); // Mengambil data kelas untuk dropdown

        return view('guru.materi.modulMateri.edit', compact('modulMateri', 'kelas'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama_materi' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $modulMateri = ModulMateri::findOrFail($id);

        // Mendapatkan tahun ajaran dari kelas yang dipilih
        $kelas = Kelas::findOrFail($request->kelas_id);
        $tahun_kurikulum_id = $kelas->tahun_kurikulum_id;

        // Memasukkan nilai 'tahun_kurikulum_id' ke dalam input
        $input = $request->all();
        $input['tahun_kurikulum_id'] = $tahun_kurikulum_id;

        $modulMateri->update($input);

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $modulMateri = ModulMateri::find($id); // Mengubah $modulmateri menjadi $modulMateri
        $modulMateri->delete();

        return redirect()->route('modulMateri.index')->with('success', 'Modul Materi berhasil dihapus.');
    }
}
