@extends('layouts.management.master')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Berita</h2>
            <form action="{{ route('berita.update', $berita->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="judul" value="{{ $berita->judul }}" required>
                </div>

                <div class="form-group">
                    <label for="kategori_id">Kategori<span style="color: red">*</span></label>
                    <select class="form-control js-example-basic-single" id="kategori_id" name="kategori_id" required>
                        @foreach ($kategori as $kategoriItem)
                            <option value="{{ $kategoriItem->id }}" {{ $kategoriItem->id == $berita->kategori_id ? 'selected' : '' }}>
                                {{ $kategoriItem->kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">Deskripsi<span style="color: red">*</span></label>
                    <textarea id="editor1" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required autocomplete="deskripsi">
                        {{ $berita->deskripsi }}
                    </textarea>
                    @error('deskripsi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

              

                <div class="form-group">
                    <label for="img_berita">Gambar</label>
                    <input id="img_berita" type="file" class="form-control @error('img_berita') is-invalid @enderror" name="img_berita" accept="image/*">
                    @error('img_berita')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <img src="{{ asset($berita->img_berita) }}" alt="Current Image" style="max-width: 200px; height: auto;">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                // Konfigurasi CKEditor 5 untuk textarea
            })
            .catch(error => {
                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
            });
    });
</script>

@endsection
