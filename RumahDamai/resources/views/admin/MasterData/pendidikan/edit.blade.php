@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Tingkat Pendidikan</h2>

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

        <form action="{{ route('pendidikan.update', $tingkatPendidikan->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tingkat_pendidikan">Jendang Pendidikan:</label>
                <input type="text" class="form-control" name="tingkat_pendidikan" value="{{ old('tingkat_pendidikan', $tingkatPendidikan->tingkat_pendidikan) }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
