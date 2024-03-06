@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Agama</h2>

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

        <form action="{{ route('agama.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="agama">Nama Agama:</label>
                <input type="text" class="form-control" name="agama" value="{{ old('agama') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
