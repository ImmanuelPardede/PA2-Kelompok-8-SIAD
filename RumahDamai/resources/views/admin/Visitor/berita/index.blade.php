@extends('layouts.management.master')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">List Berita</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('admin.berita.create') }}" class="btn btn-success mb-3">Tambahkan Data</a>
            </div>

            <div class="table-responsive">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($berita->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ada.</td>
                        </tr>
                        @else
                        @foreach($berita as $index => $beritaItem)
                        <tr>
                            <td>{{ $index +1}}</td>
                            <td style="max-width: 200px;">
                                <img src="{{ asset($beritaItem->img_berita) }}" alt="berita Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">
                            </td>
                            <td style="word-wrap: break-word;">
                                @if (strlen($beritaItem->judul) > 60)
                                    {{ substr($beritaItem->judul, 0, 60) }}...
                                @else
                                    {{ $beritaItem->judul }}
                                @endif
                            </td>
                            <td>{{$beritaItem->kategori->kategori }}</td>
                            <td>
                                <a href="{{ route('admin.berita.show', $beritaItem->id) }}" class="btn btn-info ">Detail</a>
                                <a href="{{ route('admin.berita.edit', $beritaItem->id) }}" class="btn btn-warning ">Edit</a>
                                <form action="{{ route('admin.berita.destroy', $beritaItem->id) }}" id="deleteForm{{ $beritaItem->id }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="handleDeleteConfirmation('deleteForm{{ $beritaItem->id }}')">Hapus</button>
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
