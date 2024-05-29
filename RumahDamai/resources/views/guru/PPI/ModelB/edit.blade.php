@extends('layouts.management.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit PPI Model B</h2>
            <form action="{{ route('ppiB.update', $ppiB->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="anak_id">Nama Anak</label>
                    <select class="form-control" id="anak_id" name="anak_id">
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
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $ppiB->deskripsi) }}</textarea>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success">Perbaharui</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
