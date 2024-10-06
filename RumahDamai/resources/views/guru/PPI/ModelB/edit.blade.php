@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Edit PPI Model B</h2>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ppiB.update', $ppiB->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
{{--
                    <!-- Nama Anak -->
                    <div class="form-group mb-3">
                        <label for="anak_id"><strong>Nama Anak</strong></label>
                        <div>{{ $anak->nama_lengkap }}</div>
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                    </div> --}}

                    <!-- File PPI B -->
                    <div class="form-group mb-3">
                        <label for="file_ppi_b">File PPI B</label>
                        <div>
                            @if ($detailppi && $detailppi->file_ppi_b)
                                <label>File Lama:
                                    <a href="{{ asset('uploads/ppiB_files/' . $detailppi->file_ppi_b) }}" target="_blank">
                                        {{ $detailppi->file_ppi_b }}
                                    </a>
                                </label><br>
                            @else
                                <span>Tidak ada file yang diunggah.</span>
                            @endif
                        </div>
                        <input type="file" class="form-control mt-2" name="file_ppi_b" accept=".pdf,.doc,.docx">
                        <small class="text-muted">Jenis file yang diizinkan: PDF, DOC, DOCX.</small>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="editor1" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required>{{ old('deskripsi', $detailppi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- CKEditor -->
                    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

                        <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                        <button type="submit" class="btn btn-success">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Initialize CKEditor -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#editor1'))
                .catch(error => {
                    console.error('Error initializing CKEditor 5:', error);
                });
        });
    </script>
@endsection
