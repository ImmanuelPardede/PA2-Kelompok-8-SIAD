@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Data Latar Belakang Anak</h1>
                    <!-- Tampilkan notifikasi jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('admin.latarBelakang.create') }}" class="btn btn-success mb-3">Tambah Latar Belakang Anak</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latarBelakangList as $latarBelakang)
                                <tr>
                                    <td>{{ App\Models\Anak::find($latarBelakang->anak_id)->nama_lengkap }}</td>
                                    <td>
                                        <a href="{{ route('admin.latarBelakang.show', $latarBelakang->id) }}" class="btn btn-info">Detail</a>
                                        <a href="{{ route('admin.latarBelakang.edit', $latarBelakang->id) }}" class="btn btn-warning">Edit</a>
                                        <!-- Tambahkan tag form untuk hapus -->
                                        <form method="POST" id="deleteForm{{ $latarBelakang->id }}" class="d-inline"
                                            action="{{ route('admin.latarBelakang.destroy', $latarBelakang->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $latarBelakang->id }}')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Tidak ada Data Latar Belakang Anak.</td> <!-- ubah colspan menjadi 2 -->
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $latarBelakangList->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
