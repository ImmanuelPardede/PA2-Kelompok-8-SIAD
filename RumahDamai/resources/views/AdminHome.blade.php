@extends('layouts.master')
    
@section('content')
<div class="row">
    <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ route('admin.home') }}</div>
    
                <div class="card-body">
                    You are a Admin User.
                    <a href="{{ route('anak.index') }}" class="btn btn-primary mt-3">Kelola Anak</a>

                    <table>
                        <th>Master Data</th>
                        <tr>
                            <td>Agama</td>
                            <td><a class="btn btn-primary mt-3" href="{{ route('agama.index') }}">Kelola Agama</a></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>
                                <a class="btn btn-primary mt-3" href="{{ route('jenisKelamin.index') }}">Kelola Jenis Kelamin</a>
                            </td>
                        </tr>
                    </table>
                
                    
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection