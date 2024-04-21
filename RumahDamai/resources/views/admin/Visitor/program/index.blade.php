@extends('layouts.management.master')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">List Program</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('program.create') }}" class="btn btn-success mb-3">Add New Program</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($program as $programItem)
                        <tr>
                            <td>{{ $programItem->id }}</td>
                            <td>
                                <img src="{{ asset($programItem->img_program) }}" alt="Program Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">
                            </td>
                            <td>{!! $programItem->kelas !!}</td>
                            <td>
                                <a href="{{ route('program.show', $programItem->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ route('program.edit', $programItem->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('program.destroy', $programItem->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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

@endsection
