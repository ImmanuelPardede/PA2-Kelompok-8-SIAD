@extends('layouts.management.master')

@section('content')
<div style="container">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Data PPI A @if ($ppiA->isNotEmpty())
                            {{ $ppiA->first()->anak->nama_lengkap }}
                        @endif
                    </h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('ppiA.create', ['anak_id' => $id]) }}" class="btn btn-success">Buat PPI</a>
                </div>

                <div class="table-responsive">
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
                                        <a href="{{ route('ppiA.detail', $ppi->id) }}" class="btn btn-info">Detail</a>
                                        <a href="{{ route('ppiA.edit', $ppi->id) }}" class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $ppi->id }}" class="d-inline"
                                            action="{{ route('ppiA.destroy', $ppi->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $ppi->id }}')">
                                                Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('ppiA.index') }}" class="col-lg-12 grid-margin stretch-card" style="text-decoration:none;">Kembali Ke daftar Raport Anak Didik</a>
</div>
@endsection
