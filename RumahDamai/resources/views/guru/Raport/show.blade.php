@extends('layouts.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">Data Anak Didik</h1>
            </div>

            <div class="table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        @if($raports->isNotEmpty())
                            <p>{{ $raports->first()->anak->nama_lengkap }}</p>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('raport.create') }}" class="btn btn-success">Create Raport</a>
                    </div>
                </div>
                
                <table class="table mt-3 table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode Bulan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($raports as $key => $raport)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $raport->periode_bulan }}</td>
                            <td>
                                <a href="{{ route('raport.destroy', $raport->id) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $raport->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $raport->id }}" action="{{ route('raport.destroy', $raport->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="{{ route('raport.edit', $raport->id) }}" class="btn btn-warning">Edit</a>

                                <a href="{{ route('raport.detail', $raport->id) }}" class="btn btn-info">Detail</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
