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
        // Get the search query from the request
        $query = $request->input('search');

        // Retrieve paginated results based on the search query
        $anakList = Anak::with('jenisKelamin') // Ensure the relationship is loaded
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('nama_lengkap', 'like', "%{$query}%")
                    ->orWhereHas('jenisKelamin', function ($q) use ($query) {
                        $q->where('jenis_kelamin', 'like', "%{$query}%"); // Filter by gender name
                    })
                    ->orWhere('status', 'like', "%{$query}%"); // Filter by status
            })->paginate(10); // Paginate the results (10 per page)

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            // Return the updated table view with paginated results
            return view('guru.DataAnak.anak._table', data: compact('anakList'))->render();
        }

        // Return the full view with paginated results and the search query
        return view('guru.DataAnak.Anak.index', compact('anakList', 'query'));
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
