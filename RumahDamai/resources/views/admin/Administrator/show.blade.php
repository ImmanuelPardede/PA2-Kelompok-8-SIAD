<!-- resources/views/admin/administrator/show.blade.php -->
@extends('layouts.master')

@section('content')
    <h1>Detail Akun</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama Lengkap: {{ $user->nama_lengkap }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            <p class="card-text">Role: 
                @if ($user->role == 'admin')
                    Admin
                @elseif ($user->role == 'guru')
                    Guru
                @elseif ($user->role == 'staff')
                    Staff
                @else
                    Role Tidak Valid
                @endif
            </p>
        </div>
    </div>

    @if ($user->role == 'admin')
        <a href="{{ route('admin.administrator.admin') }}" class="btn btn-primary mt-3">Kembali</a>
    @elseif ($user->role == 'guru')
        <a href="{{ route('admin.administrator.guru') }}" class="btn btn-primary mt-3">Kembali</a>
    @elseif ($user->role == 'staff')
        <a href="{{ route('admin.administrator.staff') }}" class="btn btn-primary mt-3">Kembali</a>
    @else
        <p>Role tidak valid.</p>
    @endif
@endsection
