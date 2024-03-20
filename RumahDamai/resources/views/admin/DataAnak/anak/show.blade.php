@extends('layouts.master')

@section('content')


<div class="container">

<<<<<<< HEAD
                <p><strong>Nama Lengkap:</strong> {{ $anak->nama_lengkap ?? 'Data tidak tersedia'}}</p>
                <p><strong>Agama:</strong> {{ $anak->agama->agama ?? 'Data tidak tersedia'}}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $anak->jenisKelamin->jenis_kelamin ?? 'Data tidak tersedia'}}</p>
                <p><strong>Golongan Darah:</strong> {{ $anak->golonganDarah->golongan_darah ?? 'Data tidak tersedia'}}</p>
                <p><strong>Kebutuhan:</strong> {{ $anak->kebutuhan->jenis_kebutuhan ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tempat Lahir:</strong> {{ $anak->tempat_lahir ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $anak->tanggal_lahir ?? 'Data tidak tersedia'}}</p>
                <p><strong>Disukai:</strong> {{ $anak->disukai ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tidak Disukai:</strong> {{ $anak->tidak_disukai ?? 'Data tidak tersedia'}}</p>
                <p><strong>Alamat:</strong> {{ $anak->alamat ?? 'Data tidak tersedia'}}</p>
                <p><strong>Kelebihan:</strong> {{ $anak->kelebihan ?? 'Data tidak tersedia'}}</p>
                <p><strong>Kekurangan:</strong> {{ $anak->kekurangan ?? 'Data tidak tersedia'}}</p>
                <p><strong>Penyakit:</strong> {{ optional($anak->penyakit)->jenis_penyakit ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $anak->tanggal_masuk ?? 'Data tidak tersedia'}}</p>
                <p><strong>Tanggal Keluar:</strong> {{ $anak->tanggal_keluar ?? 'Data tidak tersedia'}}</p>
                <p><strong>Status:</strong> {{ $anak->status ?? 'Data tidak tersedia'}}</p>
=======
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Detail Anak</h4>
      <p class="card-description">
Orang tua?      </p>
      <div class="row">
        <div class="col-md-8">
>>>>>>> 9811a7324785d883538fd1e2ab4fb83ca41fe96d

      <div class="table-responsive">
        <table class="table">
          <tbody>

    <th>Nama Lengkap</th>
    <td>{{ $anak->nama_lengkap }}</td>
</tr>
<tr>
    <th>Agama</th>
    <td>{{ $anak->agama->agama }}</td>
</tr>
<tr>
    <th>Jenis Kelamin</th>
    <td>{{ $anak->jenisKelamin->jenis_kelamin }}</td>
</tr>
<tr>
    <th>Golongan Darah</th>
    <td>{{ $anak->golonganDarah->golongan_darah }}</td>
</tr>
<tr>
    <th>Kebutuhan</th>
    <td>{{ $anak->kebutuhan->jenis_kebutuhan }}</td>
</tr>
<tr>
    <th>Tempat Lahir</th>
    <td>{{ $anak->tempat_lahir }}</td>
</tr>
<tr>
    <th>Tanggal Lahir</th>
    <td>{{ $anak->tanggal_lahir }}</td>
</tr>
<tr>
    <th>Tanggal Masuk</th>
    <td>{{ $anak->tanggal_masuk }}</td>
</tr>
<tr>
    <th>Tanggal Keluar</th>
    <td>{{ $anak->tanggal_keluar }}</td>
</tr>
<tr>
    <th>Disukai</th>
    <td>{{ $anak->disukai }}</td>
</tr>
<tr>
    <th>Tidak Disukai</th>
    <td>{{ $anak->tidak_disukai }}</td>
</tr>
<tr>
    <th>Alamat</th>
    <td>{{ $anak->alamat }}</td>
</tr>
<tr>
    <th>Kelebihan</th>
    <td>{{ $anak->kelebihan }}</td>
</tr>
<tr>
    <th>Kekurangan</th>
    <td>{{ $anak->kekurangan }}</td>
</tr>
<tr>
    <th>Penyakit</th>
    <td>{{ optional($anak->penyakit)->jenis_penyakit }}</td>
</tr>
          </tbody>
        </table>
        
      </div>
      <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
      

    </div>
    <div class="col-md-4">
        <div class="image-frame">
            @if($anak->foto_profil)
            <img src="{{ asset($anak->foto_profil) }}" alt="Foto Profil Anak" class="img-fluid rounded">
            @else
            <p>Tidak ada foto profil.</p>
            @endif
        </div>
    </div>
</div>

<div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('anak.edit', $anak->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('anak.destroy', $anak->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
  </div>
</div>
</div>
@endsection
