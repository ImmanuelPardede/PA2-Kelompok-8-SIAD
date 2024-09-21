@extends('layouts.management.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit PPI Model B</h2>
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
            <form action="{{ route('ppiB.update', $ppiB->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="anak_id">Nama Anak</label>
                    <select class="form-control js-example-basic-single" id="anak_id" name="anak_id">
                        <option value="" disabled>-- Nama Anak --</option>
                        @foreach ($anak as $anakdata)
                            <option value="{{ $anakdata->id }}" {{ $ppiB->anak_id == $anakdata->id ? 'selected' : '' }}>
                                {{ $anakdata->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="file_ppi_b">File PPI B</label>
                    <input type="file" class="form-control" name="file_ppi_b">
                    <small class="text-muted">Jenis file yang diizinkan: PDF, DOC, DOCX.</small>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $ppiB->deskripsi) }}</textarea>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success" id="submitButton" onclick="handleUpdatedConfirmation(event)">Perbaharui</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
