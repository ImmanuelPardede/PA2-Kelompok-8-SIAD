<?php

namespace App\Http\Controllers\Guru\DataAnak;

use App\Exports\ExportAnak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;

class AnakController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $anakList = Anak::where('nama_lengkap', 'like', "%{$search}%")
                ->orderBy('created_at', 'desc')
                ->paginate(7);
        } else {
            $anakList = Anak::orderBy('created_at', 'desc')->paginate(7);
        }

        return view('guru.DataAnak.Anak.index', compact('anakList'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anak = Anak::with('agama', 'jenisKelamin', 'golonganDarah', 'kebutuhanDisabilitas', 'penyakit', 'lokasiTugas')->find($id);
        $penyakit = $anak->penyakit;

        return view('guru.DataAnak.Anak.show', compact('anak', 'penyakit'));
    }

    public function generatePDF($id)
    {
        $anak = Anak::findOrFail($id);

        // Load view content into a variable
        $pdfView = view('guru.DataAnak.anak.pdf', compact('anak'))->render();

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
        $filename = 'anak_profile_' . str_replace(' ', '_', $anak->nama_lengkap) . '.pdf';

        // Output PDF to browser
        return $dompdf->stream($filename);
    }

    public function exportExcel()
    {
        return Excel::download(new ExportAnak, 'anak.xlsx');
    }
}
