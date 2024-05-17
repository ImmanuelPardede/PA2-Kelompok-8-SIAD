<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport {{ $raport->anak->nama_lengkap }}</title>
    <style>
            @page {
        size: landscape;
    }
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
        h2{
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-100{
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
            border: none; /* Remove borders from all cells */
            padding: 8px;
            text-align: left;
        }

        .atasan {
            margin-top: 10px; /* Ubah nilai margin-top sesuai kebutuhan */
            margin-bottom: 10px; /* Ubah nilai margin-bottom sesuai kebutuhan */
            text-align: center;
        }

        .atasan img {
            margin-right: 20px; /* Jarak antara gambar dan teks */
            width: 75px;
        }

.yayasan {
    font-size: 24px;
    font-size: 3vw;
    text-align: center; /* Menyatukan teks ke tengah */
}

.garis1{
  border-top:3px solid black;
  height: 2px;
  border-bottom:1px solid black;
}
#tls{
 text-align:right; 
}

#camat{
    text-align:right;
    margin-right: 80px;
  }
  #nama-camat{
    margin-top:100px;
    margin-right: 85px;
    text-align:right;
  }
    </style>
</head>
<body>
    <header>
        <div class="atasan">
            <div class="konten" style="text-align: center;">
                <h2>YAYASAN PENDIDIKAN ANAK RUMAH DAMAI</h2>
                <h3>@if($anak->lokasi_id == 1)Lumban Silintong @elseif ($anak->lokasi_id == 2) Andam Dewi @endif</h3>
                <h4>@if ($anak->lokasi_id == 1)Jl. Pemandian, Lumban Silintong, Balige 22651, Toba, Sumatra Utara, Indonesia
                    @elseif ($anak->lokasi_id == 2)Sawah Lamo, Andam Dewi 22651, Kabupaten Tapanuli Tengah, Sumatra Utara, Indonesia
                        @else
                        Data Alamat Tidak Tersedia
                    @endif</h4>
            </div>
        </div>
      </header>
      <hr class="garis1"/>
      <h4 style="text-align: center">Laporan Hasil Belajar Siswa</h4>
        <div class="row">
            <div class="col">
                <table class="no-border-table"> <!-- Add custom class to the table -->
                    <tbody style="font-size: 12px;">
                        <tr>
                            <td>Nomor Induk Anak</td>
                            <td>: {{ $raport->anak->nia }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $raport->anak->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td>T.A</td>
                            <td>: {{ $raport->tahunajaran->tahun_ajaran }}/ {{ $raport->semester->semester_tahun_ajaran }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="">
                    <thead>
                        <tr>
                            <td style="width: 50px  ;font-weight: bold; background-color: #ccc; font-size: 13px;">No</td>
                            <td style="width: 300px ;font-weight: bold; background-color: #ccc; font-size: 13px;">Mata Pelajaran</td>
                            <td style="width: 250px ;font-weight: bold; background-color: #ccc; font-size: 13px;">Kemampuan yang dipelajari</td>
                            <td style="width: 350px ;font-weight: bold; background-color: #ccc; font-size: 13px;">Hasil Yang Dicapai</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                $prevArea = null;
                $nomorTampil = 0;
                @endphp

                        @foreach($detailraports as $index => $detail)
                        <tr>
                            <td style="font-weight: bold; font-size: 12px;">{{ $loop->iteration }}</td>
                            <td style="font-weight: bold; font-size: 12px;"> <!-- Added font-size: 12px -->
                                {{ $detail->matapelajaran->nama_kelas }}
                            </td>
                            <td style="font-weight: bold; font-size: 12px;"> <!-- Added font-size: 12px -->
                                {{ $detail->grade }}
                            </td>
                            <td style="text-align: left; font-size: 12px;"> <!-- Added font-size: 12px -->
                                {!! $detail->keterangan !!}
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <p id="camat" style="font-size: 12px;"><strong>Guru Rumah Damai</strong></p>
                <div id="nama-camat" style="font-size: 12px;"><strong><u>{{ $raport->user->nama_lengkap }}</u></strong><br />
              NIP. {{ $raport->user->nip }}</div>
              </div>
              </div>
    </div>
</body>
</html>
