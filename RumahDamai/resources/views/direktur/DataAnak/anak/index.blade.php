@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="display-5 font-weight-bold text-left">Data Anak</h1>
                    <!-- Tampilkan notifikasi jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="d-flex">
                        <a href="{{ route('direktur.anak.create') }}" class="btn btn-success">Tambah Anak</a>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('direktur.anak.export.excel') }}" class="btn btn-primary mr-auto">Export to Excel</a>
                    <form action="{{ route('direktur.anak.index') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control typeahead" placeholder="Cari Nama Anak" aria-label="Cari Nama Anak" value="{{ request('search') ?? '' }}">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anakList as $anak)
                                <tr>
                                    <td><img src="{{ asset($anak->foto_profil) }}" alt=""></td>
                                    <td>{{ $anak->nama_lengkap }}</td>
                                    <td>{{ $anak->jenisKelamin->jenis_kelamin }}</td>
                                    <td>{{ $anak->status }}</td>
                                    <td>
                                        <a href="{{ route('direktur.anak.show', $anak->id) }}" class="btn btn-info">Detail</a>
                                        <a href="{{ route('direktur.anak.edit', $anak->id) }}" class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $anak->id }}" class="d-inline" action="{{ route('anak.destroy', $anak->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="handleDeleteConfirmation('deleteForm{{ $anak->id }}')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Tidak ada Data Anak.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $anakList->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
