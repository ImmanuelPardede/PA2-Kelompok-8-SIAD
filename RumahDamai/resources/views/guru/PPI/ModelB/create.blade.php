@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah PPI B</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('ppiB.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="anak_id">Anak<span style="color: red">*</span></label>
                        <select name="anak_id" id="anak_id" class="form-control js-example-basic-single">
                            <option value="" disabled selected>-- Pilih Anak --</option>
                            @foreach ($filteredAnak as $anakItem)
                                <option value="{{ $anakItem->id }}">{{ $anakItem->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div id="format_laporan_container" class="form-group">
                        @foreach ($formatLaporanList as $formatLaporan)
                            @if ($formatLaporan->kodeLaporan->kode === 'PPIB')
                                <div>
                                    <p>Format Laporan: {{ $formatLaporan->nama_laporan }}</p>
                                    <p>File: <a href="{{ route('downloadFormatLaporan', $formatLaporan->id) }}"
                                            target="_blank">{{ $formatLaporan->format_laporan }}</a></p>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="file_ppi_b">File PPI B<span style="color: red">*</span></label>
                        <input type="file" name="file_ppi_b" id="file_ppi_b" class="form-control">
                        <small class="text-muted">Jenis file yang diizinkan: PDF, DOC, DOCX.</small>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="editor1" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                            autocomplete="deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
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
