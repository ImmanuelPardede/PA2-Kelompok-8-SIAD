<!-- resources/views/adminss/edit.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="card mt-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{ route('accounts.update', ['id' => $account->id, 'type' => $type]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                
                    <!-- Your form fields go here, e.g. -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $account->name }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $account->email }}">
                    </div>
                    
                
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
