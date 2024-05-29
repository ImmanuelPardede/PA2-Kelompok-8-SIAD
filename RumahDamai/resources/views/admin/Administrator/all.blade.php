@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="display-5 font-weight-bold text-left">Daftar Akun Yayasan Rumah Damai</h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="d-flex">
                        <a href="{{ route('export.excel') }}" class="btn btn-primary btn-icon-text mr-2">
                            <span>Excel</span><i class="mdi mdi-file-excel btn-icon-append"></i>
                        </a>

                        <form action="{{ route('admin.administrator.all') }}" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Nama User" aria-label="Cari Nama User" value="{{ request('search') ?? '' }}">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>


                <div class="table-responsive">
                    @if ($users->count() > 0)
                        <table class="table mt-3 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->nama_lengkap }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href="{{ route('admin.administrator.show', $user->id) }}"
                                                class="btn btn-info">Detail</a>
                                            <a href="{{ route('admin.administrator.edit', $user->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form method="POST" id="deleteForm{{ $user->id }}" class="d-inline"
                                                action="{{ route('admin.administrator.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="handleDeleteConfirmation('deleteForm{{ $user->id }}')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada akun admin yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
