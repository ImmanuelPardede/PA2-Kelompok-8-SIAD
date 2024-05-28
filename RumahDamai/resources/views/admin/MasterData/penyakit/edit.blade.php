@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Jenis Penyakit</h2>

                <!-- Tampilkan pesan kesalahan validasi jika ada -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.penyakit.update', $jenisPenyakit->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="jenis_penyakit">Jenis Penyakit</label>
                        <input type="text" class="form-control" name="jenis_penyakit"
                            value="{{ old('jenis_penyakit', $jenisPenyakit->jenis_penyakit) }}">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $jenisPenyakit->deskripsi) }}</textarea>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" id="submitButton" class="btn btn-success mr-2"
                        onclick="handleUpdatedConfirmation(event)">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
