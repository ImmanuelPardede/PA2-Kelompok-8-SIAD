@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Form Kode Laporan</h2>
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

                <form action="{{ route('admin.kodeLaporan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode Laporan</label>
                        <input type="text" class="form-control" name="kode" value="{{ old('kode') }}">
                        @error('kode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
