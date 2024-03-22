<?php

namespace App\Http\Controllers\Raport;

use App\Http\Controllers\Controller;
use App\Models\Raport;
use App\Models\Anak;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raports = Raport::all();
        return view('Raport.index', compact('raports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anak = Anak::all();
        return view('raport.create', compact('anak'));

    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'anak_id' => 'required',
            'periode_awal' => 'required',
            'periode_akhir' => 'required',
            'area.*' => 'required',
            'kemampuan.*' => 'required',
            'kelas_kemampuan.*' => 'required',
            'naratif.*' => 'required',
        ]);
    
        $anakId = $request->input('anak_id');
        $periodeAwal = $request->input('periode_awal');
        $periodeAkhir = $request->input('periode_akhir');
    
        $jumlahData = count($request->input('area'));
    
        for ($i = 0; $i < $jumlahData; $i++) {
            $raportData = [
                'anak_id' => $anakId,
                'periode_bulan' => $periodeAwal[$i] . ' - ' . $periodeAkhir[$i],
                'area' => $validatedData['area'][$i],
                'kemampuan' => $validatedData['kemampuan'][$i],
                'kelas_kemampuan' => $validatedData['kelas_kemampuan'][$i],
                'naratif' => $validatedData['naratif'][$i],
            ];
    
            Raport::create($raportData);
        }
    
        return redirect()->route('raport.index')
            ->with('success', 'Raport created successfully.');
    }
    

    public function show(Raport $raport)
    {
        return view('raport.show', compact('raport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Raport $raport)
    {
        $anak = Anak::all();
        return view('raport.edit', compact('raport','anak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Raport $raport)
    {
        $validatedData = $request->validate([
            'area' => 'required',
            'anak_id' => 'required',
            'kemampuan' => 'required',
            'kelas_kemampuan' => 'required',
            'naratif' => 'required',
        ]);

        $raport->update($validatedData);

        
        return redirect()->route('raport.index')
            ->with('success', 'Raport updated successfully.');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Raport $raport)
    {
        $raport->delete();

        return redirect()->route('raport.index')
            ->with('success', 'Raport deleted successfully');
    }

    public function pdf($id)
    {
        $raport = Raport::findOrFail($id);
        $namaFile = 'raport_' . str_replace(' ', '_', $raport->anak->nama_lengkap) . '_' . str_replace(' ', '', $raport->periode_bulan) . '.pdf';
        $pdf = PDF::loadview('raport.pdf', ['raport' => $raport]);
        return $pdf->download($namaFile);
    }
    
    
}
