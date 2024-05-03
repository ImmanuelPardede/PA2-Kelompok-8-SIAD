<?php

namespace App\Http\Controllers\Chart;

use App\Http\Controllers\Controller;
use App\Models\Anak;

class ChartAnakController extends Controller
{
    public function index()
    {
        $totalAnakStatus = $this->json_status();
        $json_tipeanak = $this->json_tipe_anak();

        return view('chart.chartAnak.index', compact('totalAnakStatus', 'json_tipeanak'));
    }

    public function json_status()
    {
        // Mengambil jumlah anak berdasarkan status aktif dan nonaktif
        $aktif = Anak::where('status', 'Aktif')->count();
        $tidakAktif = Anak::where('status', '!=', 'Aktif')->count();

        $data = [
            'aktif' => $aktif,
            'tidak_aktif' => $tidakAktif,
        ];

        return $data;
    }



    public function json_tipe_anak()
    {
        // Mengambil jumlah anak berdasarkan tipe (disabilitas dan non-disabilitas)
        $query = Anak::selectRaw('tipe_anak, COUNT(*) as total')
            ->groupBy('tipe_anak')
            ->get();

        $data = [];
        foreach ($query as $row) {
            $data['tipe_anak'][] = $row->tipe_anak;
            $data['total'][] = $row->total;
        }

        return $data;
    }
}
