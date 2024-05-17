@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Latar Belakang Anak</h2>

                <div class="row">
                    <div class="col-md">

                        <form action="{{ route('latarBelakang.update', $latarBelakang->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="anak_id">Nama</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                    value="{{ $latarBelakang->anak->nama_lengkap }}" readonly>
                                <input type="hidden" id="anak_id" name="anak_id" value="{{ $latarBelakang->anak->id }}">
                            </div>


                            <div class="form-group">
                                <label for="usia">Usia</label>
                                <input type="number" class="form-control" id="usia" name="usia"
                                    value="{{ $latarBelakang->usia }}" required>
                            </div>

                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    value="{{ $latarBelakang->kelas }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    value="{{ $latarBelakang->tanggal }}" required>
                            </div>


                            @php
                                $deskripsiArray = json_decode($latarBelakang->deskripsi, true);
                                $index = 0; // Define and set $index to an initial value
                                $deskripsiSatuNilai = $deskripsiArray[$index] ?? ''; // Ambil nilai sesuai indeks gambar
                            @endphp

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ $deskripsiSatuNilai }}</textarea>
                            </div>





                            @if ($latarBelakang->gambarLatarBelakang->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latarBelakang->gambarLatarBelakang as $index => $gambar)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="image-container"
                                                            style="width: 200px; height: 200px; overflow: hidden; border-radius: 5px; margin-bottom: 20px;">
                                                            <div class="image-frame"
                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                                <img src="{{ asset('uploads/gambar_latar_belakang/' . $gambar->nama) }}"
                                                                    alt="Gambar Latar Belakang"
                                                                    style="width: 100%; height: auto; object-fit: cover; border-radius: 5px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('latarBelakang.update', $gambar->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="gambar_latar_belakang">Edit Gambar</label>
                                                            <input type="file" class="form-control"
                                                                id="gambar_latar_belakang_{{ $index }}"
                                                                name="gambar_latar_belakang_{{ $index }}">
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <p>Tidak ada gambar dan deskripsi.</p>
                            @endif

                            <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                            <button type="submit" id="submitButton" class="btn btn-primary mr-2"
                                onclick="handleUpdatedConfirmation(event)">Perbarui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
