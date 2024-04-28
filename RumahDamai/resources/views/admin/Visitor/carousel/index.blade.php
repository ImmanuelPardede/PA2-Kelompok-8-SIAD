@extends('layouts.management.master')

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Carousel Items</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('carousel.create') }}" class="btn btn-success mb-3">Add New Carousel Item</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Caption</th>
                            <th>Subcaption</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carouselItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ $item->image_url }}" alt="Carousel Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">
                            </td>
                            <td>{{ $item->caption }}</td>
                            <td>{{ $item->subcaption }}</td>
                            <td>
                                <a href="{{ route('carousel.show', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ route('carousel.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('carousel.destroy', $item->id) }}" method="POST" style="display: inline-block;">
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
