@extends('layouts.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Nama Materi</h1>
                    <!-- Tampilkan notifikasi jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('modulMateri.create') }}" class="btn btn-success mb-3">Tambah Modul Materi</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Materi</th>
                                <th scope="col">Modul Minggu</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($modulMateriList as $modulMateri)
                                <tr>
                                    <td>{{ $modulMateri->nama_materi }}</td>
                                    <td>{{ $modulMateri->mingguPembelajaran->minggu_pembelajaran }}</td>
                                    <td>
                                        <a href="{{ route('modulMateri.show', $modulMateri->id) }}"
                                            class="btn btn-info">Detail</a>
                                        <a href="{{ route('modulMateri.edit', $modulMateri->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('modulMateri.destroy', $modulMateri->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Tidak Modul Materi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $modulMateriList->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
