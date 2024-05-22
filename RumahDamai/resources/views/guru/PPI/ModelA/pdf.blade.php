<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport {{ $ppiA->anak->nama_lengkap }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-100 {
            width: 100%;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        .no-border-table td, .no-border-table th {
            border: none;
            padding: 8px;
            text-align: left;
        }
        .atasan {
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
        .atasan img {
            margin-right: 20px;
            width: 75px;
        }
        .yayasan {
            font-size: 24px;
            font-size: 3vw;
            text-align: center;
        }
        .garis1 {
            border-top: 3px solid black;
            height: 2px;
            border-bottom: 1px solid black;
        }
        #tls {
            text-align: right; 
        }
        #camat {
            text-align: right;
            margin-right: 80px;
        }
        #nama-camat {
            margin-top: 100px;
            margin-right: 85px;
            text-align: right;
        }
    </style>
</head>
<body>
    <header>
        <div class="atasan">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents('uploads/logo/logo.png')) }}" alt="">
            <div class="konten" style="text-align: center;">
                <h2>YAYASAN PENDIDIKAN ANAK RUMAH DAMAI</h2>
                <h4>
                    @if($ppiA->anak->lokasi_id == 1)
                        Lumban Silintong
                    @elseif ($ppiA->anak->lokasi_id == 2)
                        Andam Dewi
                    @endif
                </h4>
                <h4>
                    @if ($ppiA->anak->lokasi_id == 1)
                        Jl. Pemandian, Lumban Silintong, Balige 22651, Toba, Sumatra Utara, Indonesia
                    @elseif ($ppiA->anak->lokasi_id == 2)
                        Sawah Lamo, Andam Dewi 22651, Kabupaten Tapanuli Tengah, Sumatra Utara, Indonesia
                    @else
                        Data Alamat Tidak Tersedia
                    @endif
                </h4>
            </div>
        </div>
    </header>
    <hr class="garis1"/>
    <h4 style="text-align: center">Format PPI Bagian A</h4>
    <div class="row">
        <div class="col">
                    <table class="no-border-table">
                        <tbody style="font-size: 12px;">
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $ppiA->anak->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Induk Anak</td>
                                <td>: {{ $ppiA->anak->nia }}</td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir</td>
                                <td>: {{ $ppiA->anak->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: {{ $ppiA->anak->jenisKelamin->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{ $ppiA->anak->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
            @foreach($detailppiA as $ppi)
            <ol style="font-size: 12px;">
                <li>
                    <h4><b>Level Komunikasi</b></h4>
                    <p>{!! $ppi->level_komunikasi !!}</p>
                </li>
                <hr>
                <li>
                    <h4><b>Gambaran sensory & lainnya</b></h4>
                    <p>{!! $ppi->gambaran_sensorik !!}</p>
                </li>
                <hr>
                <li>
                    <h4><b>Informasi penting tentang anak</b></h4>
                    <p>{!! $ppi->informasi_penting !!}</p>
                </li>
                <hr>
                <li>
                    <h4><b>Kondisi lain yang berhubungan dengan anak</b></h4>
                    <p>{!! $ppi->kondisi_lain !!}</p>
                </li>
                <hr>
                <li>
                    <h4><b>Layanan lain yang sebaiknya diberikan</b></h4>
                    <p>{!! $ppi->layanan_lain !!}</p>
                </li>
                <hr>
                <li>
                    <h4><b>Tujuan Jangka Panjang (mimpi tiga atau lima tahun yang akan datang)</b></h4>
                    <p>{!! $ppi->tujuan_jangka_panjang !!}</p>
                </li>
                <hr>
                <li>
                    <h4><b>Tujuan Jangka pendek (satu tahun)</b></h4>
                    <p>{!! $ppi->tujuan_jangka_pendek !!}</p>
                </li>
            </ol>
            @endforeach
        </div>
    </div>
</body>
</html>
