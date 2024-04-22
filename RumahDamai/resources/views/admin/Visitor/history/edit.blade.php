@extends('layouts.management.master') <!-- Meng-extend layout master -->

@section('content') <!-- Bagian content dari layout -->

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Foundation History</h1>

            <!-- Form untuk mengupdate foundation history -->
            <form method="POST" action="{{ route('history.update', $history->id) }}" enctype="multipart/form-data">
                @csrf <!-- Token CSRF -->
                @method('PUT') <!-- Method PUT untuk update -->

                <!-- Tampilkan gambar saat ini -->
                @if ($history->gambar)
                    <div class="mb-3">
                        <label for="current_image" class="form-label"></label>
                        <img src="{{ asset($history->gambar) }}" alt="Current Image" style="max-width: 300px;">
                    </div>
                @endif

                <div class="mb-3">
                    <label for="gambar" class="form-label">Image</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="sejarah_singkat" class="form-label">Sejarah Singkat</label>
                    <textarea class="form-control" id="sejarah_singkat" name="sejarah_singkat" rows="5" required>{{ $history->sejarah_singkat }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tujuan_utama" class="form-label">Tujuan Utama</label>
                    <textarea class="form-control" id="tujuan_utama" name="tujuan_utama" rows="5" required>{{ $history->tujuan_utama }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="dibangun" class="form-label">Dibangun</label>
                    <input type="date" class="form-control" id="dibangun" name="dibangun" value="{{ $history->dibangun }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Foundation History</button>
            </form>
        </div>
    </div>
</div>

@endsection <!-- Akhir dari bagian content -->

