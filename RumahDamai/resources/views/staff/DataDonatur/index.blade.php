@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Data Donatur</h1>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form action="{{ route('dataDonatur.index') }}" method="GET">
                        <div class="form-group">
                            <select class="form-control js-example-basic-single custom-selectDropdown" name="tanggal_donatur" id="tanggal_donatur"
                                onchange="this.form.submit()">
                                <option value="" disabled selected>-- Pilih Tahun --</option>
                                @foreach ($tanggalDonaturList as $tanggalDonatur)
                                    <option value="{{ $tanggalDonatur->tahun }}"
                                        {{ request('tanggal_donatur') == $tanggalDonatur->tahun ? 'selected' : '' }}>
                                        {{ $tanggalDonatur->tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <a href="{{ route('dataDonatur.create') }}" class="btn btn-success mb-3">Tambah Donatur</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Donatur</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donaturList as $donatur)
                                <tr>
                                    <td>{{ $donatur->nama_donatur }}</td>
                                    <td>
                                        <a href="{{ route('dataDonatur.show', $donatur->id) }}"
                                            class="btn btn-info">Detail</a>
                                        <a href="{{ route('dataDonatur.edit', $donatur->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $donatur->id }}" class="d-inline"
                                            action="{{ route('dataDonatur.destroy', $donatur->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $donatur->id }}')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Tidak Data Donatur.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            
                <div class="row mt-4">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                {{ $donaturList->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
