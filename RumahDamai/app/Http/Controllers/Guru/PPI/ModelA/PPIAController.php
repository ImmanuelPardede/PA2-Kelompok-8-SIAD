<?php

namespace App\Http\Controllers\Guru\PPI\ModelA;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\DetailPpiA;
use App\Models\PpiModelA;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PPIAController extends Controller
{
    public function index()
    {
        $anak = Anak::all();
        return view('guru.ppi.modelA.index', compact('anak'));
    }

    public function show($id)
    {
        $anak = Anak::all();
        $ppiA = PpiModelA::where('anak_id', $id)->get();
        return view('guru.ppi.modelA.show', compact('ppiA', 'anak', 'id'));
    }

    public function detail($id)
    {
        $ppiA = PpiModelA::findOrFail($id);
        $detailppi = DetailPpiA::where('ppiA_id', $id)->get(); // Pastikan variabel ini terdefinisi
        return view('guru.ppi.ModelA.detail', compact('ppiA', 'detailppi'));
    }


    public function create($anak_id)
    {
        $anak = Anak::findOrFail($anak_id);
        $ppiA = PpiModelA::where('anak_id', $anak_id)->get();
        $loggedInUserId = Auth::id();

        $users = User::where('role', 'guru')->where('id', $loggedInUserId)->get();
        return view('guru.ppi.modelA.create', compact('anak', 'ppiA', 'anak_id'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'anak_id' => 'required|exists:anak,id',
            'level_komunikasi' => 'required|string',
            'gambaran_sensorik' => 'required|string',
            'informasi_penting' => 'required|string',
            'kondisi_lain' => 'nullable|string',
            'layanan_lain' => 'nullable|string',
            'tujuan_jangka_panjang' => 'required|string',
            'tujuan_jangka_pendek' => 'required|string',
        ]);

        try {
            // Buat entri PpiModelA baru
            $ppiA = new PpiModelA();
            $ppiA->anak_id = $request->input('anak_id');
            $ppiA->user_id = Auth::id(); // Assign logged in user ID
            $ppiA->save();

            // Buat entri DetailPpiA baru
            $detailPpiA = new DetailPpiA();
            $detailPpiA->ppiA_id = $ppiA->id;
            $detailPpiA->level_komunikasi = $request->input('level_komunikasi');
            $detailPpiA->gambaran_sensorik = $request->input('gambaran_sensorik');
            $detailPpiA->informasi_penting = $request->input('informasi_penting');
            $detailPpiA->kondisi_lain = $request->input('kondisi_lain');
            $detailPpiA->layanan_lain = $request->input('layanan_lain');
            $detailPpiA->tujuan_jangka_panjang = $request->input('tujuan_jangka_panjang');
            $detailPpiA->tujuan_jangka_pendek = $request->input('tujuan_jangka_pendek');
            $detailPpiA->save();

            // Redirect ke halaman raport dengan pesan sukses
            return redirect()->route('ppiA.show', ['id' => $ppiA->anak_id])->with('success', 'Raport berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }


    public function edit($id)
    {
        $ppiA = PpiModelA::findOrFail($id);
        $anak = Anak::find($ppiA->anak_id); // Fetch the specific Anak related to the raport
        $detailppi = DetailPpiA::where('ppiA_id', $id)->get(); // Pastikan variabel ini terdefinisi
        return view('guru.ppi.modelA.edit', compact('ppiA', 'detailppi', 'anak'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'anak_id' => 'required|exists:anak,id',
            'level_komunikasi' => 'required|string',
            'gambaran_sensorik' => 'required|string',
            'informasi_penting' => 'required|string',
            'kondisi_lain' => 'nullable|string',
            'layanan_lain' => 'nullable|string',
            'tujuan_jangka_panjang' => 'required|string',
            'tujuan_jangka_pendek' => 'required|string',
        ]);

        try {
            // Ambil data PpiModelA yang akan diupdate
            $ppiA = PpiModelA::findOrFail($id);
            $ppiA->anak_id = $request->input('anak_id');
            $ppiA->user_id = Auth::id(); // Assign logged in user ID
            $ppiA->save();

            // Update data DetailPpiA
            $detailPpiA = DetailPpiA::where('ppiA_id', $ppiA->id)->first();
            $detailPpiA->level_komunikasi = $request->input('level_komunikasi');
            $detailPpiA->gambaran_sensorik = $request->input('gambaran_sensorik');
            $detailPpiA->informasi_penting = $request->input('informasi_penting');
            $detailPpiA->kondisi_lain = $request->input('kondisi_lain');
            $detailPpiA->layanan_lain = $request->input('layanan_lain');
            $detailPpiA->tujuan_jangka_panjang = $request->input('tujuan_jangka_panjang');
            $detailPpiA->tujuan_jangka_pendek = $request->input('tujuan_jangka_pendek');
            $detailPpiA->save();

            // Redirect ke halaman show dengan pesan sukses
            return redirect()->route('ppiA.show', ['id' => $ppiA->anak_id])->with('success', 'Raport berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }


    public function destroy($id)
    {
        // Ambil informasi anak terkait dengan raport yang akan dihapus
        $ppiA = PpiModelA::findOrFail($id);
        $anakId = $ppiA->anak_id;

        // Hapus terlebih dahulu semua detailraports terkait
        DetailPpiA::where('ppiA_id', $id)->delete();

        // Kemudian hapus Raport
        $ppiA->delete();

        return redirect()->route('ppiA.show', ['id' => $anakId])->with('success', 'Raport berhasil dihapus.');
    }


    public function pdf($id)
    {
        $ppiA = PpiModelA::findOrFail($id);
        $detailppiA = DetailPpiA::where('ppiA_id', $id)->get();

        // Load view content into a variable
        $pdfView = view('guru.PPI.ModelA.pdf', compact('ppiA', 'detailppiA'))->render();

        // Setup Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Instantiate Dompdf with options
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($pdfView);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Create stream context to disable SSL verification
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ]);

        // Set stream context for Dompdf
        $dompdf->setHttpContext($context);

        // Render PDF (optional: save to file)
        $dompdf->render();

        // Get child's name for PDF filename
        $filename = 'ppi_ModelA_' . str_replace(' ', '_', $ppiA->anak->nama_lengkap) . '.pdf';

        // Output PDF to browser
        return $dompdf->stream($filename);
    }
}
