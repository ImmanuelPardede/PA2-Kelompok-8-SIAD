@extends('layouts.management.master')

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">About</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($abouts->isEmpty())
                <a href="{{ route('admin.about.create') }}" class="btn btn-success mb-3">Tambahkan Data</a>
            @endif

        </div>

            <div class="table-responsive">
                <table class="table mt-3 ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Latar Belakang</th>
                            <th>Wilayah I</th>
                            <th>Wilayah II</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($abouts->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Data tidak ada.</td>
                            </tr>
                        @else
                        @foreach($abouts as $index => $item)
                        <tr>
                            <td>{{ $index +1 }}</td>
                            <td>{{ \Illuminate\Support\Str::words($item->latar_belakang,3,'...') }}</td>
                            <td>{{ \Illuminate\Support\Str::words($item->wilayah1,3,'...') }}</td>
                            <td>{{ \Illuminate\Support\Str::words($item->wilayah2,3,'...') }}</td>
                            <td>
                                <a href="{{ route('admin.about.show', $item->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('admin.about.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.about.destroy', $item->id) }}" id="deleteForm{{ $item->id }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="handleDeleteConfirmation('deleteForm{{ $item->id }}')">Delete</button>

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
