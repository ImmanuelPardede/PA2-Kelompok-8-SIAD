@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Fasilitas Item</h1>

            <!-- Form untuk mengupdate fasilitas item -->
            <form method="POST" action="{{ route('fasilitas.update', $fasilitas->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
                <div class="mb-3">
                    <label for="fasilitas" class="form-label">fasilitas<span style="color: red">*</span></label>
                    <textarea id="editor1" class="form-control @error('fasilitas') is-invalid @enderror" name="fasilitas" required autocomplete="fasilitas">
                        {{ $fasilitas->fasilitas }}
                        </textarea>
                    @error('fasilitas')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

<!-- Tampilkan gambar saat ini dan input untuk mengganti atau menghapus gambar -->
@foreach ($fasilitas->detailFasilitas as $index => $detailFasilitas)
<div class="mb-4">
    <label for="img_fasilitas_{{ $index }}" class="form-label">Gambar {{ $index + 1 }}</label>
    <div class="input-group">
        <input type="file" class="form-control" id="img_fasilitas_{{ $index }}" name="img_fasilitas[{{ $index }}]" accept="image/*">
        <button type="button" class="btn btn-danger" onclick="removeImage({{ $index }})">Remove</button>
    </div>
    <div class="mt-2">
        @if ($detailFasilitas->img_fasilitas)
        <img src="{{ asset($detailFasilitas->img_fasilitas) }}" alt="Current Image" class="img-fluid" style="max-width: 300px;">
        @endif
    </div>
    <small class="text-muted">Max file size: 2MB | Allowed formats: jpeg, png, jpg, gif</small>
</div>
@endforeach

                <!-- Tombol untuk submit form -->
                <button type="submit" class="btn btn-primary">Update Fasilitas Item</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                // Konfigurasi CKEditor 5 untuk textarea pertama
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>


@endsection
