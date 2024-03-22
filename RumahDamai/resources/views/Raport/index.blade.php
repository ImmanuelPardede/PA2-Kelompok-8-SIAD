<!-- resources/views/raport/index.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Daftar Raport</h2>
        <div class="mb-3">
            <a href="{{ route('raport.create') }}" class="btn btn-success">Create Raport</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Anak</th>
                    <th>Periode Bulan</th>
                    <!-- Tambahkan kolom lain jika diperlukan -->
                    <th>Aksi</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($raports as $raport)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $raport->anak->nama_lengkap }}</td>
                        <td>{{ $raport->periode_bulan }}</td>
                        
                        <!-- Tambahkan kolom lain jika diperlukan -->
                        <td>
                            <!-- Tambahkan tombol untuk show, edit, dan delete -->
                            <a href="{{ route('raport.show', $raport->id) }}" class="btn btn-success">Show</a>
                            <a href="{{ route('raport.edit', $raport->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('raport.destroy', $raport->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
