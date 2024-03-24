<?php

namespace App\Http\Controllers\Raport;

use App\Http\Controllers\Controller;
use App\Models\Raport;
use App\Models\Anak;
use App\Models\DetailRaport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB; // Tambahkan ini di atas class controller Anda


class RaportController extends Controller
{
    /* public function index()
    {
        $anak = Anak::all();
        return view('raport.index', compact('anak'));
    }

    public function show($id)
    {
        $raports = Raport::where('anak_id', $id)->get();
        return view('raport.show', compact('raports'));
    }

    public function create()
    {
        $anak = Anak::all();
        return view('raport.create', compact('anak'));    }

    public function detail($id)
    {
        $raport = Raport::findOrFail($id);
        return view('raport.detail', compact('raport'));
    }

    public function store(Request $request)
    {  
        $request->validate([
            'anak_id' => 'required',
            'periode_awal' => 'required', // Ubah validasi menjadi 'periode_awal'
            'periode_akhir' => 'required', // Tambahkan validasi untuk 'periode_akhir'
            'area' => 'required',
            'kemampuan' => 'required',
            'kelas_kemampuan' => 'required',
            'naratif' => 'required',
        ]);
        
        // Gabungkan 'periode_awal' dan 'periode_akhir' menjadi 'periode_bulan'
        $request->merge([
            'periode_bulan' => $request->input('periode_awal') . ' - ' . $request->input('periode_akhir')
        ]);
    
        // Simpan data termasuk 'periode_bulan'
        $raport = Raport::create($request->all());
    
        return redirect()->route('raport.index')
            ->with('success', 'Raport created successfully.');
    }
    

    public function edit($id)
    {
        $raport = Raport::findOrFail($id);
        return view('raport.edit', compact('raport'));
    }

    public function update(Request $request, $id)
    {  
        $request->validate([
            'anak_id' => 'required',
            'periode_awal' => 'required',
            'periode_akhir' => 'required',
            'area' => 'required',
            'kemampuan' => 'required',
            'kelas_kemampuan' => 'required',
            'naratif' => 'required',
        ]);
        
        $request->merge([
            'periode_bulan' => $request->input('periode_awal') . ' - ' . $request->input('periode_akhir')
        ]);
    
        $data = $request->except(['periode_awal', 'periode_akhir']);
    
        $raport = Raport::findOrFail($id);
        $raport->update($data);
    
        return redirect()->route('raport.index')->with('success', 'Raport updated successfully.');
    }

    public function destroy($id)
    {
        $raport = Raport::findOrFail($id);
        $raport->delete();
    
        return redirect()->route('raport.index')->with('success', 'Raport deleted successfully.');
    }

    public function pdf($id)
    {
        $raport = Raport::findOrFail($id);
        $namaFile = 'raport_' . str_replace(' ', '_', $raport->anak->nama_lengkap) . '_' . str_replace(' ', '', $raport->periode_bulan) . '.pdf';
        $pdf = PDF::loadview('raport.pdf', ['raport' => $raport]);
        return $pdf->download($namaFile);
    } */


    public function index()
    {
        $anak = Anak::all();
        return view('raport.index', compact('anak'));
    }

    public function show($id)
    {
        $raports = Raport::where('anak_id', $id)->get();
        return view('raport.show', compact('raports'));
    }

    public function create()
    {
        $anak = Anak::all();
        return view('raport.create', compact('anak'));    }

        public function detail($id)
        {
            $raport = Raport::findOrFail($id);
            $detailraports = DetailRaport::where('raport_id', $id)->get();
            return view('raport.detail', compact('raport', 'detailraports'));
        }
        
    public function store(Request $request)
{  
    $request->validate([
        'anak_id' => 'required',
        'periode_awal' => 'required',
        'periode_akhir' => 'required',
        'area' => 'required',
        'kemampuan' => 'required',
        'kelas_kemampuan' => 'required',
        'naratif' => 'required',
    ]);

    // Gabungkan 'periode_awal' dan 'periode_akhir' menjadi 'periode_bulan'
    $periode_bulan = $request->input('periode_awal') . ' - ' . $request->input('periode_akhir');

    // Simpan data Raport
/*     dd($request->all());
 */
    $raport = new Raport;
    $raport->anak_id = $request->input('anak_id');
    $raport->periode_bulan = $periode_bulan;
    $raport->save();

    // Simpan data DetailRaport
/*     $detailraport = new DetailRaport;
    $detailraport->raport_id = $raport->id; // Menggunakan ID Raport yang baru saja disimpan
    $detailraport->area = $request->input('area');
    $detailraport->kemampuan = $request->input('kemampuan');
    $detailraport->kelas_kemampuan = $request->input('kelas_kemampuan');
    $detailraport->naratif = $request->input('naratif');    
    $detailraport->save(); */

    $areas = $request->input('area');
    $kemampuans = $request->input('kemampuan');
    $kelas_kemampuans = $request->input('kelas_kemampuan');
    $naratifs = $request->input('naratif');

    foreach ($areas as $key => $area) {
        $data2 = [
            'raport_id' => $raport->id,
            'area' => $area,
            'kemampuan' => $kemampuans[$key],
            'kelas_kemampuan' => $kelas_kemampuans[$key],
            'naratif' => $naratifs[$key],
        ];

        DetailRaport::create($data2);
    }

    return redirect()->route('raport.index')
        ->with('success', 'Raport created successfully.');
}

    

    public function edit($id)
    {
        $raport = Raport::findOrFail($id);
        return view('raport.edit', compact('raport'));
    }

    public function update(Request $request, $id)
    {  
        $request->validate([
            'anak_id' => 'required',
            'periode_awal' => 'required',
            'periode_akhir' => 'required',
            'area' => 'required',
            'kemampuan' => 'required',
            'kelas_kemampuan' => 'required',
            'naratif' => 'required',
        ]);
        
        $request->merge([
            'periode_bulan' => $request->input('periode_awal') . ' - ' . $request->input('periode_akhir')
        ]);
    
        $data = $request->except(['periode_awal', 'periode_akhir']);
    
        $raport = Raport::findOrFail($id);
        $raport->update($data);
    
        return redirect()->route('raport.index')->with('success', 'Raport updated successfully.');
    }

public function destroy($id)
{
    // Hapus terlebih dahulu semua detailraports terkait
    DetailRaport::where('raport_id', $id)->delete();

    // Kemudian hapus Raport
    $raport = Raport::findOrFail($id);
    $raport->delete();

    return redirect()->route('raport.index')->with('success', 'Raport deleted successfully.');
}


public function pdf($id)
{
    $raport = Raport::findOrFail($id);
    $detailraport = DetailRaport::where('raport_id', $id)->get();
    $namaFile = 'raport_' . str_replace(' ', '_', $raport->anak->nama_lengkap) . '_' . str_replace(' ', '', $raport->periode_bulan) . '.pdf';
    $pdf = PDF::loadview('raport.pdf', compact('raport', 'detailraport'));
    return $pdf->download($namaFile);
}




    
    
}
