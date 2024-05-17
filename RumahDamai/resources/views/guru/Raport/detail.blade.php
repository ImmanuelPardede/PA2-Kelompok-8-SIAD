@extends('layouts.management.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">LAPORAN HASIL BELAJAR SISWA</h2>
            <div class="table">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Nama</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $raport->anak->nama_lengkap }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>NIA</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $raport->anak->nia }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Tahun</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $raport->tahunajaran->tahun_ajaran }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4"><strong>Semester</strong></div>
                            <div class="col-sm-10 bg-secondary">{{ $raport->semester->semester_tahun_ajaran }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <h6 class="card-subtitle mb-2 text-muted">Detail Raports:</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Mata Pelajaran</th>
                            <th style="text-align: center;">Grade</th>
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
            <a href="{{ route('raport.pdf', $raport->id) }}" class="btn btn-success">Download PDF</a>
            <a href="{{ url()->previous() }}" class="btn btn-primary">Kemabali</a>
        </div>
    </div>
@endsection
