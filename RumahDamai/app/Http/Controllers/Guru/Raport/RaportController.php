<?php

namespace App\Http\Controllers\Guru\Raport;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Raport;
use App\Models\Anak;
use App\Models\DetailRaport;
use App\Models\SemesterTahunAjaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan ini di atas class controller Anda


class RaportController extends Controller
{
    public function index()
    {
        $anak = Anak::all();
        return view('guru.raport.index', compact('anak'));
    }

    public function show($id)
    {
        $anak = Anak::all();
        $raports = Raport::where('anak_id', $id)->get();
        return view('guru.raport.show', compact('raports','anak'));
    }

    public function detail($id)
    {
        $raport = Raport::findOrFail($id);
        $detailraports = DetailRaport::where('raport_id', $id)->get(); // Pastikan variabel ini terdefinisi
        return view('guru.raport.detail', compact('raport', 'detailraports'));
    }
        

    public function create()
    {
        $anak = Anak::all();
        $semester = SemesterTahunAjaran::all();
        $tahunajaran = TahunAjaran::all();
        $matapelajaran = Kelas::all();

        return view('guru.raport.create', compact('anak','semester','tahunajaran','matapelajaran'));    
    }


        public function store(Request $request)
    {  
        $request->validate([
            'anak_id' => 'required',
            'semester_id' => 'required',
            'tahun_ajaran_id' => 'required',

            'mata_pelajaran_id' => 'required',
            'grade' => 'required',
            'keterangan' => 'required',
        ]);

        // Inspect the request data

        $raport = new Raport;
        $raport->anak_id = $request->input('anak_id');
        $raport->tahun_ajaran_id = $request->input('tahun_ajaran_id');
        $raport->semester_id = $request->input('semester_id');
        $raport->user_id = Auth::id(); // Correctly set user_id from authenticated user

        $raport->save();


        $matepelajaran = $request->input('mata_pelajaran_id');
        $grades = $request->input('grade');
        $keterangans = $request->input('keterangan');

        foreach ($matepelajaran as $key => $matepelajarans) {
            $data2 = [
                'raport_id' => $raport->id,
                'mata_pelajaran_id' => $matepelajarans,
                'grade' => $grades[$key],
                'keterangan' => $keterangans[$key],
            ];


            DetailRaport::create($data2);
        }

        $anakId = $request->input('anak_id');

        return redirect()->route('raport.show', ['id' => $anakId])->with('success', 'Raport created successfully.');
    }


    

    public function edit($id)
    {
        $raport = Raport::findOrFail($id);
        $anak = Anak::all();
        $semester = SemesterTahunAjaran::all();
        $tahunajaran = TahunAjaran::all();
        $matapelajaran = Kelas::all();
        $detailraports = DetailRaport::where('raport_id', $id)->get(); // Change variable name here
    
        return view('guru.raport.edit', compact('raport', 'anak', 'semester', 'tahunajaran', 'matapelajaran', 'detailraports'));    
    }
    
    
    public function update(Request $request, $id)
    {  
        $request->validate([
            'anak_id' => 'required',
            'semester_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'grade' => 'required',
            'keterangan' => 'required',
        ]);
        
        // Simpan data Raport
        $raport = Raport::findOrFail($id);
        $raport->anak_id = $request->input('anak_id');
        $raport->tahun_ajaran_id = $request->input('tahun_ajaran_id');
        $raport->semester_id = $request->input('semester_id');
        $raport->save();
    
        
        // Simpan data DetailRaport yang baru
        $matepelajaran = $request->input('mata_pelajaran_id');
        $grades = $request->input('grade');
        $keterangans = $request->input('keterangan');
    
        foreach ($matepelajaran as $key => $matepelajarans) {
            $data2 = [
                'raport_id' => $raport->id,
                'mata_pelajaran_id' => $matepelajarans,
                'grade' => $grades[$key],
                'keterangan' => $keterangans[$key],
            ];
        
            // Perbaikan: Menggunakan ID detail raport dari $key dan mengirimkan data yang diperbarui
            $detail = DetailRaport::findOrFail($key);
            $detail->update($data2); // Memperbarui detail raport dengan data yang diberikan
        }
        
    
        $anakId = $raport->anak_id;
        
        return redirect()->route('raport.show', ['id' => $anakId])->with('success', 'Raport updated successfully.');
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

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);

    
    $raport = Raport::findOrFail($id);
    $anak = $raport->anak;
    $detailraports = DetailRaport::where('raport_id', $id)->get(); // Change variable name here
    $namaFile = 'raport_' . str_replace(' ', '_', $raport->anak->nama_lengkap) . '_' . str_replace(' ', '', $raport->periode_bulan) . '.pdf';
    $pdf = PDF::loadview('guru.raport.pdf', compact('raport', 'detailraports','anak'));
    return $pdf->download($namaFile);
    
}




    
    
}
