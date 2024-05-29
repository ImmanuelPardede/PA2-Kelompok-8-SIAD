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
        return view('guru.raport.show', compact('raports', 'anak', 'id'));
    }

    public function detail($id)
    {
        $raport = Raport::findOrFail($id);
        $detailraports = DetailRaport::where('raport_id', $id)->get(); // Pastikan variabel ini terdefinisi
        return view('guru.raport.detail', compact('raport', 'detailraports'));
    }

    public function create($anak_id)
    {
        $anak = Anak::findOrFail($anak_id);
        $semester = SemesterTahunAjaran::all();
        $tahunajaran = TahunAjaran::all();
        $matapelajaran = Kelas::all();
        $raport = Raport::where('anak_id', $anak_id)->get();
        return view('guru.raport.create', compact('anak', 'semester', 'tahunajaran', 'matapelajaran', 'raport', 'anak_id'));
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

        // Check if there is already a report for the same year and semester
        $existingReport = Raport::where('anak_id', $request->input('anak_id'))
            ->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'))
            ->where('semester_id', $request->input('semester_id'))
            ->exists();

        if ($existingReport) {
            return back()->withErrors(['Raport untuk tahun ajaran dan semester yang sama sudah ada.']);
        }

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

        return redirect()->route('raport.show', ['id' => $anakId])->with('success', 'Raport berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $raport = Raport::findOrFail($id);
        $anak = Anak::find($raport->anak_id); // Fetch the specific Anak related to the raport
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

        $existingIds = DetailRaport::where('raport_id', $raport->id)->pluck('id')->toArray();

        foreach ($matepelajaran as $key => $matepelajarans) {
            $data2 = [
                'raport_id' => $raport->id,
                'mata_pelajaran_id' => $matepelajarans,
                'grade' => $grades[$key],
                'keterangan' => $keterangans[$key],
            ];

            if (isset($existingIds[$key])) {
                DetailRaport::where('id', $existingIds[$key])->update($data2);
                unset($existingIds[$key]);
            } else {
                DetailRaport::create($data2);
            }
        }

        if (!empty($existingIds)) {
            DetailRaport::whereIn('id', $existingIds)->delete();
        }

        $anakId = $raport->anak_id;

        return redirect()->route('raport.show', ['id' => $anakId])->with('success', 'Raport berhasil di ubah.');
    }

    public function destroy($id)
    {
        // Ambil informasi anak terkait dengan raport yang akan dihapus
        $raport = Raport::findOrFail($id);
        $anakId = $raport->anak_id;

        // Hapus terlebih dahulu semua detailraports terkait
        DetailRaport::where('raport_id', $id)->delete();

        // Kemudian hapus Raport
        $raport->delete();

        return redirect()->route('raport.show', ['id' => $anakId])->with('success', 'Raport berhasil dihapus.');
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
        $pdf = PDF::loadview('guru.raport.pdf', compact('raport', 'detailraports', 'anak'));
        return $pdf->download($namaFile);
    }
}
