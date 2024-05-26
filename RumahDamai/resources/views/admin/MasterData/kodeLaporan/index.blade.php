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
                    <a href="{{ route('admin.kodeLaporan.create') }}" class="btn btn-success mb-3">Tambah Kode Laporan</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Laporan</th>
                                <th scope="col">Format Laporan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kodeLaporanList as $kodeLaporan)
                                <tr>
                                    <td>{{ $kodeLaporan->kode }}</td>
                                    <td>
                                        <a href="{{ route('admin.kodeLaporan.edit', $kodeLaporan->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $kodeLaporan->id }}" class="d-inline"
                                            action="{{ route('admin.kodeLaporan.destroy', $kodeLaporan->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $kodeLaporan->id }}')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Tidak ada Format Laporan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $kodeLaporanList->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleDeleteConfirmation(formId) {
            if (confirm('Anda yakin ingin menghapus Format Laporan ini?')) {
                document.getElementById(formId).submit();
            }
        }
    </script>
@endsection
