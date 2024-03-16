@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Detail Orang Tua/Wali</h2>

        <p><strong>Nama Anak:</strong> {{ $orangtuawali->anak ? $orangtuawali->anak->nama_lengkap : 'Data tidak tersedia' }}</p>
        <p><strong>Agama:</strong> {{ $orangtuawali->agama ? $orangtuawali->agama->agama : 'Data tidak tersedia' }}</p>
        <p><strong>Nama Ibu:</strong> {{ $orangtuawali->nama_ibu }}</p>
        <p><strong>Nama Ayah:</strong> {{ $orangtuawali->nama_ayah }}</p>
        <p><strong>NIK Ayah:</strong> {{ $orangtuawali->nik_ayah}}</p>
        <p><strong>NIK Ibu:</strong> {{ $orangtuawali->nik_ibu }}</p>
        <p><strong>Tanggal Lahir Ayah:</strong> {{ $orangtuawali->tanggal_lahir_ayah }}</p>
        <p><strong>Tanggal Lahir Ibu:</strong> {{ $orangtuawali->tanggal_lahir_ibu }}</p>
        <p><strong>Alamat Orang Tua:</strong> {{ $orangtuawali->alamat_orangtua }}</p>
        <p><strong>Pendidikan Ayah:</strong> {{ $orangtuawali->pendidikan_ayah ?: 'Data tidak tersedia' }}</p>
        <p><strong>Pekerjaan Ayah:</strong> {{ $orangtuawali->pekerjaan_ayah ? $orangtuawali->pekerjaan_ayah->jenis_pekerjaan : 'Data tidak tersedia' }}</p>
        <p><strong>No Hp Ayah:</strong> {{ $orangtuawali->no_hp_ayah }}</p>
        <p><strong>Pendidikan Ibu:</strong> {{ $orangtuawali->pendidikan_ibu ?: 'Data tidak tersedia' }}</p>
        <p><strong>Pekerjaan Ibu:</strong> {{ $orangtuawali->pekerjaan_ibu ? $orangtuawali->pekerjaan_ibu->jenis_pekerjaan : 'Data tidak tersedia' }}</p>
        <p><strong>No Hp Ibu:</strong> {{ $orangtuawali->no_hp_ibu }}</p>
        <p><strong>Nama Wali:</strong> {{ $orangtuawali->nama_wali ?: 'Data tidak tersedia' }}</p>
        <p><strong>Alamat Wali:</strong> {{ $orangtuawali->alamat_wali ?: 'Data tidak tersedia' }}</p>
        <p><strong>Pekerjaan Wali:</strong> {{ $orangtuawali->pekerjaan_wali ? $orangtuawali->pekerjaan_wali->jenis_pekerjaan : 'Data tidak tersedia' }}</p>
        <p><strong>Tanggal Lahir Wali:</strong> {{ $orangtuawali->tanggal_lahir_wali ?: 'Data tidak tersedia' }}</p>

        <a href="{{ route('orangTuaWali.edit', $orangtuawali->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('orangTuaWali.destroy', $orangtuawali->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
    </div>
@endsection