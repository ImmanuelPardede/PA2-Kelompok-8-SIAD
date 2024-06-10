@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Materi</h2>
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
                <form action="{{ route('modulMateri.update', $modulMateri->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kelas_id">Nama Kelas</label>
                        <select class="form-control js-example-basic-single" id="kelas_id" name="kelas_id">
                            <option value="" disabled>-- Nama Kelas --</option>
                            @foreach ($kelas as $kelasdata)
                                <option value="{{ $kelasdata->id }}"
                                    {{ $modulMateri->kelas_id == $kelasdata->id ? 'selected' : '' }}>
                                    {{ $kelasdata->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_materi">Nama Materi</label>
                        <input type="text" class="form-control" name="nama_materi"
                            value="{{ old('nama_materi', $modulMateri->nama_materi) }}">
                    </div>

                    <div class="form-group">
                        <label for="minggu_pembelajaran_id">Minggu Pembelajaran</label>
                        <select class="form-control js-example-basic-single" id="minggu_pembelajaran_id" name="minggu_pembelajaran_id">
                            <option value="" disabled>-- Minggu Pembelajaran --</option>
                            @foreach ($mingguPembelajaran as $mingguPembelajarandata)
                                <option value="{{ $mingguPembelajarandata->id }}"
                                    {{ $modulMateri->minggu_pembelajaran_id == $mingguPembelajarandata->id ? 'selected' : '' }}>
                                    {{ $mingguPembelajarandata->minggu_pembelajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file_modul">File Modul</label>
                        <input type="file" class="form-control" name="file_modul">
                        <small class="text-muted">Jenis file yang diizinkan: PDF, DOC, DOCX.</small>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $modulMateri->deskripsi) }}</textarea>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" id="submitButton" class="btn btn-success mr-2"
                        onclick="handleUpdatedConfirmation(event)">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
