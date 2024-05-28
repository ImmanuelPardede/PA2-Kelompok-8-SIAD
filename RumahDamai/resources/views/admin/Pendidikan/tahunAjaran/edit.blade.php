@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Tahun Ajaran</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.tahunAjaran.update', $tahunAjaran->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Kurikulum</label>
                        <input type="year" class="form-control" name="tahun_ajaran"
                            value="{{ old('tahun_ajaran', $tahunAjaran->tahun_ajaran) }}">
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" id="submitButton" class="btn btn-success mr-2"
                        onclick="handleUpdatedConfirmation(event)">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
