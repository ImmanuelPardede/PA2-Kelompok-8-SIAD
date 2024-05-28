@extends('layouts.management.master')

@section('content')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Fasilitas</h1>
                <!-- Tampilkan notifikasi jika ada -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($fasilitas->isEmpty())
                <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-success mb-3">Tambahkan Data</a>
                @endif

            </div>



            <div class="table-responsive">
                <table class="table mt-3 ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">Gambar</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($fasilitas->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ada.</td>
                        </tr>
                        @else
                        @foreach($fasilitas as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="max-width: 200px;">
                                @if ($item->detailFasilitas->isNotEmpty())
                                <?php $detail = $item->detailFasilitas->first(); ?>
                                <img src="{{ asset($detail->img_fasilitas) }}" alt="Fasilitas Image" class="img-fluid" style="border-radius: initial; width: 100%; height: auto; max-width: 100%;">
                            @else
                                <p>No Image</p>
                            @endif
                            </td>
                            <td>
                                @if (strlen($item->fasilitas) > 100)
                                    {!! substr($item->fasilitas, 0, 100) !!}...
                                @else
                                    {!! $item->fasilitas !!}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.fasilitas.show', $item->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('admin.fasilitas.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" id="deleteForm{{ $item->id }}" method="POST" style="display: inline-block;">
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
