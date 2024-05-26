@extends('layouts.management.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Detail Program</h4>
            <div class="d-flex justify-content-center mb-4">
                <img src="{{ asset($program->img_program) }}" alt="Gambar Program" class="img-fluid" style="width: 500px; height: auto;">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Kelas</th>
                                    <td>{!! $program->kelas !!}</td>
                                </tr>
                                <tr>
                                    <th>Detail Program</th>
                                    <td>
                                        @foreach ($detailPrograms as $detail)
                                            <div class="mb-3">
                                                <strong>Jenis Program:</strong> {{ $detail->jenis_program }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>Deskripsi:</strong> {{ $detail->deskripsi }}
                                            </div>
                                            <hr>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.program.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
