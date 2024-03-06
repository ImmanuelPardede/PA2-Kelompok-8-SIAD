@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Jenis kebutuhan</h2>

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

        <form action="{{ route('kebutuhan.update', $jenisKebutuhan->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="jenis_kebutuhan">Jenis Kebutuhan:</label>
                <input type="text" class="form-control" name="jenis_kebutuhan" value="{{ old('jenis_kebutuhan', $jenisKebutuhan->jenis_kebutuhan) }}" required>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection