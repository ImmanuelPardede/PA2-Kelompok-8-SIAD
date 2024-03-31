@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Materi</h2>

                <form action="{{ route('modulMateri.update', $modulMateri->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kelas_id">Nama Kelas</label>
                        <select class="form-control" id="kelas_id" name="kelas_id">
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
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi', $modulMateri->deskripsi) }}</textarea>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
