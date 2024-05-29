@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Data Raport @if ($raports->isNotEmpty())
                            {{ $raports->first()->anak->nama_lengkap }}
                        @endif
                    </h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('raport.create', ['anak_id' => $id]) }}" class="btn btn-success">Buatkan Raport</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Semester</th>
                                <th>Periode Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($raports as $key => $raport)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $raport->semester->semester_tahun_ajaran }}</td>
                                    <td>{{ $raport->tahunajaran->tahun_ajaran }}</td>
                                    <td>
                                        <a href="{{ route('raport.detail', $raport->id) }}" class="btn btn-info">Detail</a>
                                        <a href="{{ route('raport.edit', $raport->id) }}" class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $raport->id }}" class="d-inline"
                                            action="{{ route('raport.destroy', $raport->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $raport->id }}')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('raport.index') }}" class="btn btn-primary">Data Raport Anak Didik</a>
            </div>
        </div>
    </div>
@endsection
