@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Format Laporan</h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('admin.formatLaporan.create') }}" class="btn btn-success mb-3">Tambah Format Laporan</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Kode Laporan</th>
                                <th scope="col">Nama Laporan</th>
                                <th scope="col">Format Laporan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($formatLaporanList as $formatLaporan)
                                <tr>
                                    <td>{{ $formatLaporan->kodeLaporan->kode }}</td>
                                    <td>{{ $formatLaporan->nama_laporan }}</td>
                                    <td>
                                        @if ($formatLaporan->format_laporan)
                                            <a href="{{ route('admin.formatLaporan.download', $formatLaporan->id) }}">{{ $formatLaporan->format_laporan }}</a>
                                        @else
                                            Data tidak tersedia
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.formatLaporan.edit', $formatLaporan->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $formatLaporan->id }}" class="d-inline"
                                            action="{{ route('admin.formatLaporan.destroy', $formatLaporan->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $formatLaporan->id }}')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Tidak ada Format Laporan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $formatLaporanList->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
