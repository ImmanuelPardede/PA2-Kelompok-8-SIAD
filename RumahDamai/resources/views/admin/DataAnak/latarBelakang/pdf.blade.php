<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Damai - Detail Latar Belakang Anak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .image-container {
            width: 350px;
            height: auto;
        }

        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .image-description-wrapper {
            display: flex;
            margin-bottom: 20px;
        }

        .image-container {
            position: relative;
            margin-right: 10px;
        }

        .image-number {
            position: absolute;
            top: 5px;
            left: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
            z-index: 1;
        }

        .description-container {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            overflow: hidden;
            background-color: #EFEFEF;
        }

        .description-text {
            font-size: 16px;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header"> <img
                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('uploads/logo/logo.png'))) }}"
                alt="Logo">
            <div class="header-text">
                <h2>YAYASAN PENDIDIKAN ANAK RUMAH DAMAI</h2>
                <p style="font-size: 16px;">
                    @if ($latarBelakang->anak->lokasi_id == 1)
                        Jl. Pemandian, Lumban Silintong, Balige 22651, Toba, Sumatra Utara, Indonesia
                    @elseif ($latarBelakang->anak->lokasi_id == 2)
                        Sawah Lamo, Andam Dewi 22651, Tapanuli Tengah, Sumatra Utara, Indonesia
                </p>
                @endif
                </p>
                <hr>
            </div>
            <div style="clear: both;"></div>
        </div>

        <h4 style="text-align: center">Peta Sejarah/Latar Belakang</h4>
        <table style="margin-bottom: 3.5em">
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
            <div class="image-description-wrapper">
                <div class="image-container">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/uploads/gambar_latar_belakang/' . $gambar->nama))) }}"
                        alt="Gambar Latar Belakang">
                    <div class="image-number">{{ $index + 1 }}</div>
                </div>
                <div class="description-container">
                    <div class="description-text">
                        {!! $latarBelakang->deskripsiLatarBelakang[$index]->deskripsi ?? 'Data tidak tersedia' !!}</div>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
