@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Data Anak Didik</h1>
                </div>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        

                <div class="table-responsive">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            @if ($ppiA->isNotEmpty())
                                <p>{{ $ppiA->first()->anak->nama_lengkap }}</p>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('ppiA.create', ['anak_id' => $id]) }}" class="btn btn-success">Buatkan PPI</a>
                        </div>
                    </div>

                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ppiA as $key => $ppi)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ppi->created_at }}</td>
                                    <td>
                                        <form method="POST" id="deleteForm{{ $ppi->id }}" class="d-inline"
                                            action="{{ route('ppiA.destroy', $ppi->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $ppi->id }}')">
                                                Hapus
                                            </button>
                                        </form>

                                        <a href="{{ route('ppiA.edit', $ppi->id) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('ppiA.detail', $ppi->id) }}" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
