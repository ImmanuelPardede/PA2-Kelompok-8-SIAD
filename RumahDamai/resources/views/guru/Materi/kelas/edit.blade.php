@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Kelas</h2>

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

        <form action="{{ route('kelas.update', $kelas->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_kelas">Nama Kelas:</label>
                <input type="text" class="form-control" name="nama_kelas"
                    value="{{ old('nama_kelas', $kelas->nama_kelas) }}">
            </div>

            <div class="form-group">
                <label for="tahun_kurikulum_id">Tahun Kurikulum:</label>
                <select class="form-control" id="tahun_kurikulum_id" name="tahun_kurikulum_id">
                    <option value="" disabled>-- Pilih Tahun Kurikulum --</option>
                    @foreach ($tahunKurikulum as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $kelas->tahun_kurikulum_id ? 'selected' : '' }}>
                            {{ $item->tahun_kurikulum }}</option>
                    @endforeach
                </select>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>

    </div>
@endsection
