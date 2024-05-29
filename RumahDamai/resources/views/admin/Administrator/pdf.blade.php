<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Diri Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            /* Menyamakan teks secara horizontal di tengah */
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
            /* Menyamakan teks secara horizontal di tengah */
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

        .gambar-pegawai {
            text-align: center;
            margin-top: 35px;
            margin-bottom: 20px;
        }

        .gambar-pegawai img {
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
                alt="Logo">
            <div class="header-text">
                <h2>YAYASAN PENDIDIKAN ANAK RUMAH DAMAI</h2>
                <p style="font-size: 16px;">
                    @if ($user->lokasi_penugasan_id == 1)
                        Jl. Pemandian, Lumban Silintong, Balige 22651, Toba, Sumatra Utara, Indonesia
                    @elseif ($user->lokasi_penugasan_id == 2)
                        Sawah Lamo, Andam Dewi 22651, Tapanuli Tengah, Sumatra Utara, Indonesia
                </p>
                @endif
                </p>
                <hr>
            </div>
            <div style="clear: both;"></div>
        </div>

        <h4 style="text-align: center;">Data Diri Pegawai</h4>
        <div class="gambar-pegawai" style="margin-bottom: 2em">
            @if ($user->foto)
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('uploads/pegawai/' . $user->foto))) }}"
                    alt="Foto Pegawai" style="width: auto; height: 170px; border: 1px solid #000;">
            @else
                <em>Foto tidak tersedia</em>
            @endif
        </div>


        <table>
            <!-- Baris-baris data pegawai -->
            <tr>
                <th>Nama</th>
                <td>{{ $user->nama_lengkap ?? '' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email ?? '' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $user->status ?? '' }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Pegawai (NIP)</th>
                <td>{{ $user->nip ?? '' }}</td>
            </tr>
            <tr>
                <th>Golongan Darah</th>
                <td>{{ $user->golonganDarah->golongan_darah ?? '' }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $user->jenisKelamin->jenis_kelamin ?? '' }}</td>
            </tr>
            <tr>
                <th>Agama</th>
                <td>{{ $user->agama->agama ?? '' }}</td>
            </tr>
            <tr>
                <th>Pendidikan</th>
                <td>{{ $user->pendidikan->tingkat_pendidikan ?? '' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $user->alamat ?? '' }}</td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <td>{{ $user->no_telepon ?? '' }}</td>
            </tr>
            <tr>
                <th>Pengalaman</th>
                <td>{!! $user->pengalaman ?? '' !!}</td>
            </tr>
            <tr>
                <th>Tanggal Masuk</th>
                <td>{{ $user->tanggal_masuk ?? '' }}</td>
            </tr>
            <tr>
                <th>Lokasi Penugasan</th>
                <td>{{ $user->lokasiPenugasan->lokasi ?? '' }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
