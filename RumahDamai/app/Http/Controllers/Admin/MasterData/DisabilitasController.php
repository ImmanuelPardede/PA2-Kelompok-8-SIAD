<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Models\Disabilitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisabilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disabilitasList = Disabilitas::orderBy('jenis_disabilitas', 'asc')->paginate(7);
        return view('admin.masterdata.disabilitas.index', compact('disabilitasList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masterdata.disabilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_disabilitas' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'jenis_disabilitas' => 'required|string|unique:disabilitas,jenis_disabilitas|regex:/^[a-zA-Z\s]+$/',
            'deskripsi' => 'required|string',
        ], [
            'kategori_disabilitas.required' => 'Kategori Disabilitas wajib diisi.',
            'kategori_disabilitas.string' => 'Kategori Disabilitas harus berupa teks.',
            'kategori_disabilitas.regex' => 'Kategori Disabilitas hanya boleh mengandung huruf dan spasi.',
            'jenis_disabilitas.required' => 'Jenis Disabilitas wajib diisi.',
            'jenis_disabilitas.string' => 'Jenis Disabilitas harus berupa teks.',
            'jenis_disabilitas.unique' => 'Jenis Disabilitas sudah ada, tidak boleh duplikat.',
            'jenis_disabilitas.regex' => 'Jenis Disabilitas hanya boleh mengandung huruf dan spasi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ]);

        Disabilitas::create($request->all());

        return redirect()->route('admin.disabilitas.index')->with('success', 'Jenis Disabilitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $disabilitas = Disabilitas::find($id);
        return view('admin.masterdata.disabilitas.show', compact('disabilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisDisabilitas = Disabilitas::findOrFail($id);
        return view('admin.masterdata.disabilitas.edit', compact('jenisDisabilitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis_disabilitas' => 'required|string|unique:disabilitas,jenis_disabilitas,' . $id . '|regex:/^[a-zA-Z\s]+$/',
            'kategori_disabilitas' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'deskripsi' => 'required|string',
        ], [
            'jenis_disabilitas.required' => 'Jenis Disabilitas wajib diisi.',
            'jenis_disabilitas.string' => 'Jenis Disabilitas harus berupa teks.',
            'jenis_disabilitas.unique' => 'Jenis Disabilitas sudah ada, tidak boleh duplikat.',
            'jenis_disabilitas.regex' => 'Jenis Disabilitas hanya boleh mengandung huruf dan spasi.',
            'kategori_disabilitas.required' => 'Kategori Disabilitas wajib diisi.',
            'kategori_disabilitas.string' => 'Kategori Disabilitas harus berupa teks.',
            'kategori_disabilitas.regex' => 'Kategori Disabilitas hanya boleh mengandung huruf dan spasi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ]);

        $jenisDisabilitas = Disabilitas::find($id);
        $jenisDisabilitas->update($request->all());

        return redirect()->route('admin.disabilitas.index')->with('success', 'Jenis Disabilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisDisabilitas = Disabilitas::findOrFail($id);
        $jenisDisabilitas->delete();

        return redirect()->route('admin.disabilitas.index')->with('success', 'Jenis Disabilitas berhasil dihapus.');
    }
}
