@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Data Kategori Berita</h1>
                    <!-- Tampilkan notifikasi jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('kategoriBerita.create') }}" class="btn btn-success mb-3">Tambah Kategori Berita</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th>Nama Kategori Berita</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategoriList as $kategori)
                                <tr>
                                    <td>{{ $kategori->kategori }}</td>
                                    <td>
                                        <a href="{{ route('kategoriBerita.edit', $kategori->id) }}" class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $kategori->id }}" class="d-inline"
                                            action="{{ route('kategoriBerita.destroy', $kategori->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $kategori->id }}')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Tidak ada data Kategori Berita.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $kategoriList->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
