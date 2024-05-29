@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Raport</h2>
                <form action="{{ route('raport.update', ['id' => $raport->id]) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Add this line for PUT method -->

                    <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                    <div class="form-group">
                        <label for="anak_nama">Nama Anak</label>
                        <input type="text" class="form-control" id="anak_nama" value="{{ $anak->nama_lengkap }}"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="semester_id">Semester<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="semester_id" name="semester_id" required>
                            <option value="" disabled selected>-- Semester--</option>
                            @foreach ($semester as $semesters)
                                <option value="{{ $semesters->id }}"
                                    {{ $raport->semester_id == $semesters->id ? 'selected' : '' }}>
                                    {{ $semesters->semester_tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Ajaran<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="tahun_ajaran_id" name="tahun_ajaran_id"
                            required>
                            <option value="" disabled selected>-- Tahun Ajaran--</option>
                            @foreach ($tahunajaran as $tahunajarans)
                                <option value="{{ $tahunajarans->id }}"
                                    {{ $raport->tahun_ajaran_id == $tahunajarans->id ? 'selected' : '' }}>
                                    {{ $tahunajarans->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    @foreach ($detailraports as $key => $detailraport)
                        <div class="form-group">
                            <label for="mata_pelajaran_id">Mata Pelajaran<span style="color: red">*</span></label>
                            <select class="form-control js-example-basic-single" id="mata_pelajaran_id"
                                name="mata_pelajaran_id[]" required>
                                <option value="" disabled selected>-- Mata Pelajaran--</option>
                                @foreach ($matapelajaran as $matapelajaranItem)
                                    <option value="{{ $matapelajaranItem->id }}"
                                        {{ $detailraport->mata_pelajaran_id == $matapelajaranItem->id ? 'selected' : '' }}>
                                        {{ $matapelajaranItem->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="grade">Grade <span style="color: red">*</span></label>
                            <div class="input-group">
                                <select class="form-control js-example-basic-single" id="grade" name="grade[]" required>
                                    <option value="A">A</option>
                                    <option value="AB">AB</option>
                                    <option value="B">B</option>
                                    <option value="BC">BC</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" id="toggleTableBtn">!</button>
                                </div>
                            </div>
                            <small id="grade-table" class="form-text text-muted" style="display: none;">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Grade</th>
                                                <th>Range</th>
                                                <th>Skala</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>A</td>
                                                <td>79,5 &lt; 100</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <td>AB</td>
                                                <td>72 &lt; 79,5</td>
                                                <td>3,5</td>
                                            </tr>
                                            <tr>
                                                <td>B</td>
                                                <td>64,5 &lt; 72</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>BC</td>
                                                <td>57 &lt; 64,5</td>
                                                <td>2,5</td>
                                            </tr>
                                            <tr>
                                                <td>C</td>
                                                <td>49,5 &lt; 57</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>D</td>
                                                <td>34 &lt; 49,5</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>E</td>
                                                <td>0 &lt; 34</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </small>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var toggleTableBtn = document.getElementById('toggleTableBtn');
                                var gradeTable = document.getElementById('grade-table');

                                toggleTableBtn.addEventListener('click', function() {
                                    if (gradeTable.style.display === 'none') {
                                        gradeTable.style.display = 'block';
                                    } else {
                                        gradeTable.style.display = 'none';
                                    }
                                });
                            });
                        </script>

                        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
                        @php
                            $keterangans = is_array($detailraport->keterangan)
                                ? $detailraport->keterangan
                                : [$detailraport->keterangan];
                        @endphp
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="editor{{ $key + 1 }}" class="form-label">Keterangan
                                    {{ $key + 1 }}<span style="color: red">*</span></label>
                                <textarea id="editor{{ $key + 1 }}" class="form-control editor @error('keterangan.' . $key) is-invalid @enderror"
                                    name="keterangan[]" required autocomplete="keterangan{{ $key + 1 }}">
                        {!! $detailraport->keterangan !!}
            </textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                    <a href="#" class="addraport btn btn-primary" style="float: right">Tambah Detail</a>
                    <div class="raport"></div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
            <script type="text/javascript">
                // Event listener untuk tombol "Tambah Detail"
                $('.addraport').on('click', function(event) {
                    event.preventDefault(); // Mencegah perilaku default dari link
                    addraport();
                });

                // Fungsi untuk menambahkan detail raport
                function addraport() {
                    var index = $('.raport div').length + 1; // Ensure each editor has a unique ID
                    var raport = `
                <div>
                    @foreach ($detailraports as $key => $detailraport)

                    <div class="form-group">
                    <label for="mata_pelajaran_id">Mata Pelajaran<span style="color: red">*</span></label>
                    <select class="form-control js-example-basic-single" name="mata_pelajaran_id[]" required>
                        <option value="" disabled selected>-- Mata Pelajaran--</option>
                        @foreach ($matapelajaran as $matapelajarans)
                            <option value="{{ $matapelajarans->id }}">{{ $matapelajarans->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>


                    <div class="form-group">
                        <label for="grade">Grade <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="grade[]" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan_${index}" class="form-label">Keterangan<span style="color: red">*</span></label>
                        <textarea id="keterangan_${index}" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan[]" required autocomplete="keterangan">
                            <ul>
                                <li>..</li>
                            </ul>
                            {{ old('keterangan') }}
                        </textarea>
                        @error('keterangan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <a href="#" class="remove btn btn-danger" style="float: right">Hapus</a>
                </div>
                @endforeach

            `;
                    $('.raport').append(raport);

                    // Initialize CKEditor for the new textarea
                    ClassicEditor
                        .create(document.querySelector(`#keterangan_${index}`))
                        .catch(error => {
                            console.error(error);
                        });
                }

                // Event listener untuk tombol "Hapus"
                $(document).on('click', '.remove', function(event) {
                    event.preventDefault(); // Mencegah perilaku default dari link
                    $(this).parent().remove();
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.editor').forEach(function(element, index) {
                        ClassicEditor
                            .create(element, {
                                // Konfigurasi CKEditor 5 untuk setiap textarea dengan class 'editor'
                            })
                            .catch(error => {
                                console.error('Ada kesalahan saat menginisialisasi CKEditor 5:', error);
                            });
                    });
                });
            </script>
        @endsection
