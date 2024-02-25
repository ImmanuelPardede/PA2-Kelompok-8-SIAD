<!-- resources/views/adminHome.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>
                    @auth('admin')
                    <p>Halo Admin</p>
                @endauth
            
                @auth('staff')
                    <p>Halo Staff</p>
                @endauth
            
                @auth('guru')
                <p>Halo guru</p>
            @endauth
                    <div class="card-body">
                        <div class="mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
