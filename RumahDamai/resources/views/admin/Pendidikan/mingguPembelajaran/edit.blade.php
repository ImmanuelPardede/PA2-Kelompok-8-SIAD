@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Minggu Pembelajaran</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mingguPembelajaran.update', $mingguPembelajaran->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="minggu_pembelajaran">Minggu Pembelajaran</label>
                <input type="text" class="form-control" name="minggu_pembelajaran" value="{{ old('minggu_pembelajaran', $mingguPembelajaran->tahun_kurikulum) }}">
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
