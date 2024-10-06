@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Data PPI B @if ($ppiB->isNotEmpty())
                            {{ $ppiB->first()->anak->nama_lengkap }}
                        @endif
                    </h1>

                    <a href="{{ route('ppiB.create', ['anak_id' => $id]) }}" class="btn btn-success">Buat PPI</a>
                </div>
                <div class="row">
                    <div class="col-md">
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
                                    @foreach ($ppiB as $key => $ppi)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($ppi->created_at)->format('d-m-Y') }}</td>
                                            <!-- Only Date -->
                                            <td>
                                                <a href="{{ route('ppiB.detail', $ppi->id) }}"
                                                    class="btn btn-info">Detail</a>
                                                <a href="{{ route('ppiB.edit', $ppi->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form method="POST" id="deleteForm{{ $ppi->id }}" class="d-inline"
                                                    action="{{ route('ppiB.destroy', $ppi->id) }}">
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
                        <div class="mt-4 d-flex justify-content-end">
                            <a href="{{ route('ppiB.index') }}" class="btn btn-back">Kembali Ke daftar PPIB Anak Didik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
