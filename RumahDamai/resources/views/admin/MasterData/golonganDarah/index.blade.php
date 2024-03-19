@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h1 class="card-title">Data Golongan Darah</h1>

                    <!-- Tampilkan notifikasi jika ada -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('golonganDarah.create') }}" class="btn btn-success mb-3">Tambah Jenis Golongan Darah</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th>Golongan Darah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($golonganDarahList as $darah)
                        <tr>
                            <td>{{ $darah->golongan_darah }}</td>
                            <td>
                                <a href="{{ route('golonganDarah.edit', $darah->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('golonganDarah.destroy', $darah->id) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">Tidak ada data kelamin.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
