@extends('layouts.management.master')

@section('content')
    <style>
        .info-card {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .info-card .title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .info-card div {
            font-size: 14px;
        }

        .card-title, .card-subtitle {
            color: #2c3e50;
        }
    </style>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h1 class="card-title">Laporan Hasil Belajar Siswa</h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">Nama</div>
                            <div>{{ $raport->anak->nama_lengkap }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">NIA</div>
                            <div>{{ $raport->anak->nia }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">Tahun</div>
                            <div>{{ $raport->tahunajaran->tahun_ajaran }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-card">
                            <div class="title">Semester</div>
                            <div>{{ $raport->semester->semester_tahun_ajaran }}</div>
                        </div>
                    </div>
                </div>
                <hr>

                <h6 class="card-subtitle mb-2 text-muted">Detail Raports:</h6>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 50px;">No</th>
                                <th style="text-align: center; width: 350px;">Mata Pelajaran</th>
                                <th style="text-align: center; width: 100px;">Grade</th>
                                <th style="text-align: center;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailraports as $index => $detailraport)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $detailraport->matapelajaran->nama_kelas }}</td>
                                    <td style="text-align: center;">{{ $detailraport->grade }}</td>
                                    <td style="white-space: pre-line;">{!! $detailraport->keterangan !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    <a href="{{ route('raport.pdf', $raport->id) }}" class="btn btn-success">Download PDF</a>
                </div>
            </div>
        </div>
    </div>
@endsection
