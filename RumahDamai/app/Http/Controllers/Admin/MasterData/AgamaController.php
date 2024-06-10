<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agama;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agamaList = Agama::orderBy('agama', 'asc')->paginate(7);
        return view('admin.masterdata.agama.index', compact('agamaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masterdata.agama.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'agama' => ['required', 'string', 'unique:agama,agama', 'regex:/^[a-zA-Z\s]+$/'],
        ], [
            'agama.required' => 'Nama agama wajib diisi.',
            'agama.string' => 'Nama agama harus berupa string.',
            'agama.unique' => 'Data agama sudah ada, tidak boleh duplikat.',
            'agama.regex' => 'Nama agama hanya boleh mengandung huruf dan spasi.',
        ]);

        Agama::create($request->all());

        return redirect()->route('agama.index')->with('success', 'Data agama berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agama = Agama::find($id);
        return view('admin.masterdata.agama.show', compact('agama'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agama = Agama::find($id);
        return view('admin.masterdata.agama.edit', compact('agama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'agama' => ['required', 'string', 'unique:agama,agama,' . $id, 'regex:/^[a-zA-Z\s]+$/'],
        ], [
            'agama.required' => 'Nama agama wajib diisi.',
            'agama.string' => 'Nama agama harus berupa string.',
            'agama.unique' => 'Data agama sudah ada, tidak boleh duplikat.',
            'agama.regex' => 'Nama agama hanya boleh mengandung huruf dan spasi.',
        ]);

        $agama = Agama::find($id);
        $agama->update($request->all());

        return redirect()->route('agama.index')->with('success', 'Data agama berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agama = Agama::find($id);
        $agama->delete();

        return redirect()->route('agama.index')->with('success', 'Data agama berhasil dihapus.');
    }
}
