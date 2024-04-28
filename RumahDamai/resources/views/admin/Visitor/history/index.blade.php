@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Foundation History</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tampilkan tombol "Add New Foundation History" hanya jika tidak ada data -->
                @if (!$history)
                    <a href="{{ route('history.create') }}" class="btn btn-success mb-3">Add New Foundation History</a>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Sejarah Singkat</th>
                            <th>Tujuan Utama</th>
                            <th>Dibangun</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($history)
                            <tr>
                                <td>
                                    <img src="{{ $history->gambar }}" alt="Foundation Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">
                                </td>
                                <td>{{ \Illuminate\Support\Str::words($history->sejarah_singkat, 3, '...') }}</td>
                                <td>{{ \Illuminate\Support\Str::words($history->tujuan_utama, 3, '...') }}</td>
                                <td>{{ $history->dibangun }}</td>
                                <td>
                                    <a href="{{ route('history.show', $history->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                    <a href="{{ route('history.edit', $history->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <form action="{{ route('history.destroy', $history->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6">No foundation history found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
