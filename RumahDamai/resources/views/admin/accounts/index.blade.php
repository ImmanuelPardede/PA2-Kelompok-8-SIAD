@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="card mt-4">
            <a href="{{ route('admin.home') }}">Go to Admin Home</a>

            <div class="card-header">
                <h3 class="mb-0">
                    Admins
                    <a href="{{ route('accounts.create') }}" class="btn btn-success btn-sm float-end">
                        <i class="fas fa-plus"></i> Add Admin
                    </a>
                </h3>
            </div>

        <!-- Display admin accounts -->
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Admins</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admin as $admins)
                            <tr>
                                <td>{{ $admins->name }}</td>
                                <td>{{ $admins->email }}</td>
                                <td>
                                    <a href="{{ route('accounts.edit', ['type' => 'admin', 'id' => $admins->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('accounts.destroy', ['type' => 'admin', 'id' => $admins->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this account?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Display guru accounts -->
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">Gurus</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guru as $gurus)
                            <tr>
                                <td>{{ $gurus->name }}</td>
                                <td>{{ $gurus->email }}</td>
                                <td>
                                    <a href="{{ route('accounts.edit', ['type' => 'guru', 'id' => $gurus->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('accounts.destroy', ['type' => 'guru', 'id' => $gurus->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this account?')">Delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Display staff accounts -->
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">Staffs</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th> <!-- Add action column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $staffs)
                        <tr>
                            <td>{{ $staffs->name }}</td>
                            <td>{{ $staffs->email }}</td>
                            <td>
                                
                                <a href="{{ route('accounts.edit', ['type' => 'staff', 'id' => $staffs->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this account?')">Delete</button>
                                </form>
                                
                                
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
