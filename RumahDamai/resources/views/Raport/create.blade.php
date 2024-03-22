@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Create Raport</h2>
    <form action="{{ route('raport.store') }}" method="POST">
        @csrf
        <div id="raportInputs">
            <div class="raport-input">
                <div class="form-group">
                    <label for="anak_id">Nama Anak</label>
                    <select class="form-control js-example-basic-single" id="anak_id" name="anak_id" required>
                        <option value="" disabled selected>-- Nama Anak --</option>
                        @foreach ($anak as $anakItem)
                        <option value="{{ $anakItem->id }}">{{ $anakItem->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periode_bulan">Periode Bulan:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="periode_awal[]" placeholder="Bulan Awal">
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text">-</span>
                        </div>
                        <input type="text" class="form-control" name="periode_akhir[]" placeholder="Bulan Akhir">
                    </div>
                </div>
                <div class="form-group">
                    <label for="area">Area:</label>
                    <input type="text" class="form-control" name="area[]" required>
                </div>
                <div class="form-group">
                    <label for="kemampuan">Kemampuan:</label>
                    <input type="text" class="form-control" name="kemampuan[]" required>
                </div>
                <div class="form-group">
                    <label for="kelas_kemampuan">Kelas Kemampuan:</label>
                    <input type="text" class="form-control" name="kelas_kemampuan[]" required>
                </div>
                <div class="form-group">
                    <label for="naratif">Naratif:</label>
                    <textarea class="form-control" name="naratif[]" required></textarea>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success" id="addRaport">Tambah Raport</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    document.getElementById('addRaport').addEventListener('click', function() {
        var raportInputs = document.getElementById('raportInputs');
        var newRaportInput = document.createElement('div');
        newRaportInput.classList.add('raport-input');
        newRaportInput.innerHTML = `
            <hr>
            <div class="form-group">
                <label for="anak_id">Nama Anak</label>
                <select class="form-control js-example-basic-single" id="anak_id" name="anak_id" required>
                    <option value="" disabled selected>-- Nama Anak --</option>
                    @foreach ($anak as $anakItem)
                    <option value="{{ $anakItem->id }}">{{ $anakItem->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="periode_bulan">Periode Bulan:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="periode_awal[]" placeholder="Bulan Awal">
                    <div class="input-group-prepend input-group-append">
                        <span class="input-group-text">-</span>
                    </div>
                    <input type="text" class="form-control" name="periode_akhir[]" placeholder="Bulan Akhir">
                </div>
            </div>
            <div class="form-group">
                <label for="area">Area:</label>
                <input type="text" class="form-control" name="area[]" required>
            </div>
            <div class="form-group">
                <label for="kemampuan">Kemampuan:</label>
                <input type="text" class="form-control" name="kemampuan[]" required>
            </div>
            <div class="form-group">
                <label for="kelas_kemampuan">Kelas Kemampuan:</label>
                <input type="text" class="form-control" name="kelas_kemampuan[]" required>
            </div>
            <div class="form-group">
                <label for="naratif">Naratif:</label>
                <textarea class="form-control" name="naratif[]" required></textarea>
            </div>
        `;
        raportInputs.appendChild(newRaportInput);
    });
</script>
@endsection
