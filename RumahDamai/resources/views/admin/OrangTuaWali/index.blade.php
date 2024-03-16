@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Data Orang Tua/Wali</h1>
                <a href="{{ route('orangTuaWali.create') }}" class="btn btn-success">Tambah Orang Tua/Wali</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nama Anak</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orangtuawaliList as $orangtuawali)
                            <tr>
                                <td>{{ $orangtuawali->anak->nama_lengkap }}</td>
                                <td>
                                    <a href="{{ route('orangTuaWali.show', $orangtuawali->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('orangTuaWali.edit', $orangtuawali->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('orangTuaWali.destroy', $orangtuawali->id) }}" method="post" class="d-inline">
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
