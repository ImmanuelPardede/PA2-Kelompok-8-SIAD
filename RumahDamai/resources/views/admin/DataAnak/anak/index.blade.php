@extends('layouts.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Data Anak</h1>
                    <!-- Tampilkan notifikasi jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('anak.create') }}" class="btn btn-success mb-3">Tambah Anak</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Kebutuhan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anakList as $anak)
                                <tr>
                                    <td><img src="{{ asset($anak->foto_profil) }}" alt=""></td>
                                    <td>{{ $anak->nama_lengkap }}</td>
                                    <td>{{ $anak->jenisKelamin->jenis_kelamin }}</td>
                                    <td>{{ $anak->kebutuhan->jenis_kebutuhan }}</td>
                                    <td>
                                        <a href="{{ route('anak.show', $anak->id) }}" class="btn btn-info">Detail</a>
                                        <a href="{{ route('anak.edit', $anak->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('anak.destroy', $anak->id) }}" method="post"
                                            style="display:inline;" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
