@extends('layouts.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title">Riwayat Medis</h1>
                    <!-- Tampilkan notifikasi jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('riwayatMedis.create') }}" class="btn btn-success mb-3">Tambah Riwayat Medis</a>
                </div>
                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th>Riwayat Medis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayatmedisList as $riwayatMedis)
                                <tr>
                                    <td>{{ $riwayatMedis->riwayat_perawatan }}</td>
                                    <td>
                                        <a href="{{ route('riwayatMedis.show', $riwayatMedis->id) }}"
                                            class="btn btn-info">Detail</a>
                                        <a href="{{ route('riwayatMedis.edit', $riwayatMedis->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('riwayatMedis.destroy', $riwayatMedis->id) }}"
                                            method="post" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Tidak ada Riwayat Medis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
