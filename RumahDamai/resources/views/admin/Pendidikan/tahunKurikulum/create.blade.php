@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Tahun Kurikulum</h2>

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

                <form action="{{ route('admin.tahunKurikulum.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="tahun_kurikulum">Tahun Kurikulum</label>
                        <input type="number" class="form-control" name="tahun_kurikulum"
                            value="{{ old('tahun_kurikulum') }}" min="1900" max="9999">
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
