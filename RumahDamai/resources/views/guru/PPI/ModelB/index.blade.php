@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">PPI Model B</h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('ppiB.create') }}" class="btn btn-success mb-3">Tambah PPI B</a>  
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
                        @forelse ($ppiBList as $ppiB)
                            <tr>
                                <td>{{ $ppiB->anak->nama_lengkap }}</td>
                                <td>
                                    <a href="{{ route('ppiB.show', $ppiB->id) }}" class="btn btn-info">Detail</a>
                                    <a href="{{ route('ppiB.edit', $ppiB->id) }}" class="btn btn-warning">Edit</a>
                                    <form method="POST" id="deleteForm{{ $ppiB->id }}" class="d-inline" action="{{ route('ppiB.destroy', $ppiB->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="handleDeleteConfirmation('deleteForm{{ $ppiB->id }}')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Tidak ada PPI B.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $ppiBList->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
