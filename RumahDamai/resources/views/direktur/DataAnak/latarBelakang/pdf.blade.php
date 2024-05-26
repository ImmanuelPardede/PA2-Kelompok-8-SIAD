<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Damai - Detail Latar Belakang Anak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            margin-bottom: 20px;
            text-align: center;
            /* Menyamakan teks secara horizontal di tengah */
        }

        .header img {
            width: 75px;
            height: auto;
            margin-right: 20px;
            float: left;
        }

        .header-text {
            overflow: hidden;
            text-align: center;
            /* Menyamakan teks secara horizontal di tengah */
        }

        .header h2,
        .header h3,
        .header h4 {
            margin: 5px 0;
        }

        .header hr {
            border: none;
            border-top: 3px solid black;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .image-container {
            width: 200px;
            height: auto;
        }

        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('uploads/logo/logo.png'))) }}"
            alt="Logo">
        <div class="header-text">
            <h2>YAYASAN PENDIDIKAN ANAK RUMAH DAMAI</h2>
            <h3>
                @if ($latarBelakang->anak->lokasi_id == 1)
                    Lumban Silintong
                @elseif ($latarBelakang->anak->lokasi_id == 2)
                    Andam Dewi
                @endif
            </h3>
            <h5 style="font-size: 16px;"> <!-- Ganti font-size sesuai kebutuhan -->
                @if ($latarBelakang->anak->lokasi_id == 1)
                    Jl. Pemandian, Lumban Silintong, Balige 22651, Toba, Sumatra Utara, Indonesia
                @elseif ($latarBelakang->anak->lokasi_id == 2)
                    Sawah Lamo, Andam Dewi 22651, Tapanuli Tengah, Sumatra Utara, Indonesia
                @else
                    Data Alamat Tidak Tersedia
                @endif
            </h5>

        </div>
        <div style="clear: both;"></div>
    </div>

    <hr class="garis1">

    <h3 style="text-align: center">Peta Sejarah/Latar Belakang</h3>
    <table>
        <tr>
            <th>Nama</th>
            <td>{{ $latarBelakang->anak->nama_lengkap }}</td>
        </tr>
        <tr>
            <th>Usia</th>
            <td>{{ $latarBelakang->usia }}</td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>{{ $latarBelakang->kelas }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ \Carbon\Carbon::parse($latarBelakang->tanggal)->format('d/m/Y') }}</td>
        </tr>
    </table>
    @foreach ($latarBelakang->gambarLatarBelakang as $index => $gambar)
        <table>
            <tr>
                <td>
                    <div class="image-container">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('uploads/gambar_latar_belakang/' . $gambar->nama))) }}"
                            alt="Gambar Latar Belakang">
                    </div>
                </td>
            </tr>
            <tr>
                <td>{{ $latarBelakang->deskripsiLatarBelakang[$index]->deskripsi ?? 'Data tidak tersedia' }}</td>
            </tr>
        </table>
    @endforeach

</body>

</html>
