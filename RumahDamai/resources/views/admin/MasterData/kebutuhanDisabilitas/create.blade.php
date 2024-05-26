@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Kebutuhan Disabilitas</h2>

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

                <form action="{{ route('admin.kebutuhanDisabilitas.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="jenis_kebutuhan_disabilitas">Nama Kebutuhan Disabilitas<span
                                style="color: red">*</span></label>
                        <input type="text" class="form-control" name="jenis_kebutuhan_disabilitas"
                            value="{{ old('jenis_kebutuhan_disabilitas') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi">{{ old('deskripsi') }}</textarea>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
