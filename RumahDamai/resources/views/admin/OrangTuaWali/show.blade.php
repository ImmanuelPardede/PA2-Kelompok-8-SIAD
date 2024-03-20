@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Detail Orang Tua/Wali</h4>
            <p class="card-description">Orang tua?</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Nama Anak:</th>
                                    <td>{{ $orangtuawali->anak ? $orangtuawali->anak->nama_lengkap : 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Agama:</th>
                                    <td>{{ $orangtuawali->agama ? $orangtuawali->agama->agama : 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Ayah:</th>
                                    <td>{{ $orangtuawali->nama_ayah ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Ibu:</th>
                                    <td>{{ $orangtuawali->nama_ibu ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>NIK Ayah:</th>
                                    <td>{{ $orangtuawali->nik_ayah ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>NIK Ibu:</th>
                                    <td>{{ $orangtuawali->nik_ibu ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir Ayah:</th>
                                    <td>{{ $orangtuawali->tanggal_lahir_ayah ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir Ibu:</th>
                                    <td>{{ $orangtuawali->tanggal_lahir_ibu ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Orang Tua</th>
                                    <td>{{ $orangtuawali->alamat_orantua ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Ayah:</th>
                                    <td>{{ $orangtuawali->pendidikan_ayah ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ayah:</th>
                                    <td>{{ $orangtuawali->pekerjaan_ayah_id ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Ibu:</th>
                                    <td>{{ $orangtuawali->pendidikan_ibu ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ibu:</th>
                                    <td>{{ $orangtuawali->pekerjaan_ibu_id ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>No Hp Ibu:</th>
                                    <td>{{ $orangtuawali->no_hp_ibu ?? 'Data tidak tersedia' }}</td>
                                </tr>                                
                                <tr>
                                    <th>Nama WAli:</th>
                                    <td>{{ $orangtuawali->nama_wali ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan WAli:</th>
                                    <td>{{ $orangtuawali->pekerjaan_wali_id ?? 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir WAli:</th>
                                    <td>{{ $orangtuawali->tanggal_lahir_wali ?? 'Data tidak tersedia' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Image or other details related to parent/wali -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('orangTuaWali.edit', $orangtuawali->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('orangTuaWali.destroy', $orangtuawali->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



