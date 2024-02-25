<!-- admin/accounts/create.blade.php -->

@extends('layouts.master') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container">
        <h2>Create Account</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('accounts.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="account_type">Account Type</label>
                <select name="account_type" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="staff">Staff</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>
@endsection
