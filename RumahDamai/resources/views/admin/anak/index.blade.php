@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Data Anak</h1>
                <a href="{{ route('anak.create') }}" class="btn btn-success">Tambah Anak</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Golongan Darah</th>
                            <th scope="col">Kebutuhan</th>
                            <th scope="col">Tempat Lahir</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anakList as $anak)
                            <tr>
                                <td>{{ $anak->id }}</td>
                                <td>{{ $anak->namaLengkap }}</td>
                                <td>{{ $anak->Agama->agama }}</td>
                                <td>{{ $anak->jenisKelamin->jenis_kelamin }}</td>
                                <td>{{ $anak->golonganDarah->golongan_darah }}</td>
                                <td>{{ $anak->kebutuhan->jenis_kebutuhan }}</td>
                                <td>{{ $anak->tempatLahir }}</td>
                                <td>{{ $anak->tanggalLahir }}</td>
                                <td>
                                    <a href="{{ route('anak.show', $anak->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('anak.edit', $anak->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('anak.destroy', $anak->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
