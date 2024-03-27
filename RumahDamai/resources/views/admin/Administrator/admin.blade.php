@extends('layouts.master')

@section('content')
    <h1>Daftar Akun Admin</h1>

    @if ($users->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users->where('role', 'admin') as $user)
                        <tr>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('admin.administrator.show', $user->id) }}" class="btn btn-sm btn-info">Show</a> <!-- Tautan Show -->
                                <a href="{{ route('admin.administrator.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.administrator.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada akun admin yang tersedia.</p>
    @endif
@endsection
