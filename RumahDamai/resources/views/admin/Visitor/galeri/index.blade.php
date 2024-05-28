@extends('layouts.management.master')

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Galeri</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($galeri)
                <a href="{{ route('admin.galeri.create') }}" class="btn btn-success mb-3">Tambahkan Data</a>
                @endif

            </div>



            <div class="table-responsive">
                <table class="table mt-3 ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">Gambar</th>
                            <th>Kegiatan</th>
                            <th>Lokasi</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($galeri->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ada.</td>
                        </tr>
                        @else
                        @foreach($galeri as $index => $item)
                        <tr>
                            <td>{{ $index +1 }}</td>
                            <td style="max-width: 200px;">
                                @if ($item->detailgaleri->isNotEmpty())
                                    <?php $detail = $item->detailgaleri->first(); ?>
                                    <img src="{{ asset($detail->img_galeri) }}" alt="galeri Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">
                                @else
                                    <p>No Image</p>
                                @endif
                            </td>

                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>
                                <a href="{{ route('admin.galeri.show', $item->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.galeri.destroy', $item->id) }}" id="deleteForm{{ $item->id }}" method="POST" style="display: inline-block;">
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
