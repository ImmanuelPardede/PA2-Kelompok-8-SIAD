@extends('layouts.master')

@section('content')
    <h1>Raport Anak</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Periode Bulan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($raports as $key => $raport)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $raport->anak->nama_lengkap }}</td>
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
    <a href="{{ route('raport.create') }}" class="btn btn-success">Create Raport</a>
    @endsection
