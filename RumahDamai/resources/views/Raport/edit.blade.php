<!-- resources/views/raport/create.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Create Raport</h2>
        <form action="{{ route('raport.update', $raport->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="anak_id">Nama Anak:</label>
                <select class="form-control" id="anak_id" name="anak_id" required>
                    <option value="" disabled>-- Anak --</option>
                    @foreach ($anak as $anakItem)
                        <option value="{{ $anakItem->id }}" {{ $raport->anak_id == $anakItem->id ? 'selected' : '' }}>
                            {{ $anakItem->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>            
            <div class="form-group">
                <label for="area">Area:</label>
                <input type="text" class="form-control" id="area" name="area" value="{{ $raport->area }}">
            </div>
            <div class="form-group">
                <label for="kemampuan">Kemampuan:</label>
                <input type="text" class="form-control" id="kemampuan" name="kemampuan" value="{{ $raport->kemampuan }}">
            </div>
            <div class="form-group">
                <label for="kelas_kemampuan">Kelas Kemampuan:</label>
                <input type="text" class="form-control" id="kelas_kemampuan" name="kelas_kemampuan" value="{{ $raport->kelas_kemampuan }}">
            </div>
            <div class="form-group">
                <label for="naratif">Naratif:</label>
                <textarea class="form-control" id="naratif" name="naratif">{{ $raport->naratif }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
