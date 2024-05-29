<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Damai</title>
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
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: 1fr 3fr;
            gap: 20px;
        }

        .gambar-anak {
            text-align: center;
            margin-top: 35px;
            margin-bottom: 20px;
        }

        .gambar-anak img {
            width: 177px;
            height: 236px;
            border: 1px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        hr {
            border: none;
            border-top: 2px solid #ddd;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents('uploads/logo/logo.png')) }}"
                alt="">
            <div class="header-text">
                <h2>YAYASAN PENDIDIKAN ANAK RUMAH DAMAI</h2>
                <p style="font-size: 16px;">
                    @if ($anak->lokasi_id == 1)
                        Jl. Pemandian, Lumban Silintong, Balige 22651, Toba, Sumatra Utara, Indonesia
                    @elseif ($anak->lokasi_id == 2)
                        Sawah Lamo, Andam Dewi 22651, Tapanuli Tengah, Sumatra Utara, Indonesia
                </p>
                @endif
                </p>
                <hr>
            </div>
            <div style="clear: both;"></div>
        </div>

        <h4 style="text-align: center">Data Anak</h4>
        <div class="gambar-anak" style="margin-bottom: 2em">
            @if ($anak->foto_profil)
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents($anak->foto_profil)) }}"
                style="width: auto; height: 170px; border: 1px solid #000;">
            @else
                <em>Foto tidak tersedia</em>
            @endif
        </div>

        <table>
            <tr>
                <th>Nama</th>
                <td>{{ $anak->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Anak (INA)</th>
                <td>{{ $anak->nia }}</td>
            </tr>
            <tr>
                <th>Agama</th>
                <td>{{ $anak->agama->agama }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $anak->jenisKelamin->jenis_kelamin }}</td>
            </tr>
            <tr>
                <th>Golongan Darah</th>
                <td>{{ $anak->golonganDarah->golongan_darah }}</td>
            </tr>
            <tr>
                <th>Tempat,Tanggal Lahir</th>
                <td>{{ $anak->tempat_lahir }}, {{ $anak->tanggal_lahir }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $anak->alamat }}</td>
            </tr>
            <tr>
                <th>Masuk</th>
                <td>{{ $anak->tanggal_masuk }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>{{ $anak->status }}</td>
            </tr>
            <tr>
                <th>Disukai</th>
                <td>{!! $anak->disukai !!}</td>
            </tr>
            <tr>
                <th>Tidak Disukai</th>
                <td>{!! $anak->tidak_disukai !!}</td>
            </tr>
            <tr>
                <th>Kelebihan</th>
                <td>{!! $anak->kelebihan !!}</td>
            </tr>
            <tr>
                <th>Kekurangan</th>
                <td>{!! $anak->kekurangan !!}</td>
            </tr>

            <!-- Tambahkan baris tambahan sesuai kebutuhan -->
        </table>
    </div>
</body>

</html>
