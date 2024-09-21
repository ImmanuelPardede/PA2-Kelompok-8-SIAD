@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Kode Laporan</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.kodeLaporan.update', $kodeLaporan->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kode">Kode Laporan</label>
                        <input type="text" class="form-control" name="kode" value="{{ old('kode', $kodeLaporan->kode) }}">
                        @error('kode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
