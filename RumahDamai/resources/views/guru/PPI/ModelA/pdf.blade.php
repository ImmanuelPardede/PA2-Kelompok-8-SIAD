<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport {{ $ppiA->anak->nama_lengkap }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 75px;
            height: auto;
            margin-right: 7px;
            float: left;
        }

        .header-text {
            overflow: hidden;
            text-align: center;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .header-bottom-text {
            overflow: hidden;
            text-align: center;
            margin-top: 0;
            padding-top: 0;
        }

        .header h2,
        .header h3,
        .header h4 {
            margin: 5px 0;
        }

        .header hr {
            border: none;
            border-top: 3px solid black;
            margin-bottom: 10px;
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

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .no-border-table td,
        .no-border-table th {
            border: none;
            padding: 8px;
            text-align: left;
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
        <div class="header"> <img
                src="data:image/png;base64,{{ base64_encode(file_get_contents('uploads/logo/logo.png')) }}"
                alt="">
            <div class="header-text">
                <h2>YAYASAN PENDIDIKAN ANAK RUMAH DAMAI</h2>
                <p style="font-size: 16px;">
                    @if ($ppiA->anak->lokasi_id == 1)
                        Jl. Pemandian, Lumban Silintong, Balige 22651, Toba, Sumatra Utara, Indonesia
                    @elseif ($ppiA->anak->lokasi_id == 2)
                        Sawah Lamo, Andam Dewi 22651, Tapanuli Tengah, Sumatra Utara, Indonesia
                </p>
                @endif
                </p>
                <hr>
            </div>
            <div style="clear: both;"></div>
        </div>
    </header>

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
            @foreach ($detailppiA as $ppi)
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
