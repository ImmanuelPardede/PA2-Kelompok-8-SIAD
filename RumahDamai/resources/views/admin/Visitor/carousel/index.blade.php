@extends('layouts.management.master')

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Carousel</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('admin.carousel.create') }}" class="btn btn-success mb-3">Tambahkan Data</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>SubJudul</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($carouselItems->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ada.</td>
                        </tr>
                        @else
                        @foreach($carouselItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset($item->image_url) }}" alt="Carousel Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">

                            </td>
                            <td>{{ $item->caption }}</td>
                            <td>{{ $item->subcaption }}</td>
                            <td>
                                <a href="{{ route('admin.carousel.show', $item->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('admin.carousel.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.carousel.destroy', $item->id) }}" id="deleteForm{{ $item->id }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="handleDeleteConfirmation('deleteForm{{ $item->id }}')">Hapus</button>
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
