@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($jadwal) ? 'Edit Jadwal Pembelajaran' : 'Tambah Jadwal Pembelajaran' }}</h1>
        <form action="{{ isset($jadwal) ? route('jadwal.update', $jadwal->id) : route('jadwal.store') }}" method="POST">
            @csrf
            @if (isset($jadwal))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select name="kelas_id" id="kelas_id" class="form-control">
                    @foreach ($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Sisipkan input lainnya seperti minggu_pembelajaran_id, materi_pembelajaran_id, guru_id, tanggal, jam_mulai, jam_selesai -->
            <button type="submit" class="btn btn-primary">{{ isset($jadwal) ? 'Simpan Perubahan' : 'Tambahkan' }}</button>
        </form>
    </div>
@endsection
