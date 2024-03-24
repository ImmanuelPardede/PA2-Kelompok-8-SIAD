@extends('layouts.master')

@section('content')
    <h1>Data Anak</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap Anak</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anak as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->nama_lengkap }}</td>
                <td>{{ $data->status }}</td>
                <td><a href="{{ route('raport.show', $data->id) }}" class="btn btn-primary">Show</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
