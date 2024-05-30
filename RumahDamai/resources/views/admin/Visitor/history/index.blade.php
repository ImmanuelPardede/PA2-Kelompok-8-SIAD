@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Sejarah Singkat Yayasan</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tampilkan tombol "Add New Foundation History" hanya jika tidak ada data -->
                @if (!$history)
                    <a href="{{ route('admin.history.create') }}" class="btn btn-success mb-3">Tambahkan Data</a>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Sejarah Singkat</th>
                            <th>Tujuan Utama</th>
                            <th>Dibangun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($history)
                            <tr>
                                <td>
                                    <img src="{{ asset($history->gambar) }}" alt="Foundation Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">
                                </td>
                                <td>{{ \Illuminate\Support\Str::words($history->sejarah_singkat, 3, '...') }}</td>
                                <td>{{ \Illuminate\Support\Str::words($history->tujuan_utama, 3, '...') }}</td>
                                <td>{{ $history->dibangun }}</td>
                                <td>
                                    <a href="{{ route('admin.history.show', $history->id) }}" class="btn btn-info">Detail</a>
                                    <a href="{{ route('admin.history.edit', $history->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.history.destroy', $history->id) }}" id="deleteForm{{ $history->id }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="handleDeleteConfirmation('deleteForm{{ $history->id }}')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Data Tidak Ada.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
