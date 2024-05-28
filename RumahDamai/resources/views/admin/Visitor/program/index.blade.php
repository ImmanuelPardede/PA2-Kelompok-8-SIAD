@extends('layouts.management.master')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">List Program Yayasan</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('admin.program.create') }}" class="btn btn-success mb-3">Tambahkan Data</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($program->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Data tidak ada.</td>
                        </tr>
                        @else
                        @foreach($program as $index => $programItem)
                        <tr>
                            <td>{{ $index +1 }}</td>
                            <td>
                                <img src="{{ asset($programItem->img_program) }}" alt="Program Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">
                            </td>
                            <td>{!! $programItem->kelas !!}</td>
                            <td>
                                <a href="{{ route('admin.program.show', $programItem->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('admin.program.edit', $programItem->id) }}" class="btn btn-warning ">Edit</a>
                                <form action="{{ route('admin.program.destroy', $programItem->id) }}" id="deleteForm{{ $programItem->id }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="handleDeleteConfirmation('deleteForm{{ $programItem->id }}')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
