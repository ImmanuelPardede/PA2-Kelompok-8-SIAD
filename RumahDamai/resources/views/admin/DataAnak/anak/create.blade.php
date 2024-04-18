@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Tambah Anak</h2>
            <form action="{{ route('anak.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nama_lengkap" required>
                </div>
                <div class="form-group">
                    <label for="agama_id">Agama <span style="color: red">*</span></label>
                    <select class="form-control js-example-basic-single" id="agama_id" name="agama_id" required>
                        <option value="" disabled selected>-- Pilih Agama --</option>
                        @foreach ($agama as $agamaItem)
                            <option value="{{ $agamaItem->id }}">{{ $agamaItem->agama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin_id">Jenis Kelamin <span style="color: red">*</span></label>
                    <select class="form-control js-example-basic-single" id="jenis_kelamin_id" name="jenis_kelamin_id" required>
                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                        @foreach ($jenisKelamin as $jenisKelaminItem)
                            <option value="{{ $jenisKelaminItem->id }}">{{ $jenisKelaminItem->jenis_kelamin }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="golongan_darah_id">Golongan Darah <span style="color: red">*</span></label>
                    <select class="form-control js-example-basic-single " id="golongan_darah_id" name="golongan_darah_id" required>
                        <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                        @foreach ($golonganDarah as $golonganDarahItem)
                            <option value="{{ $golonganDarahItem->id }}">{{ $golonganDarahItem->golongan_darah }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipe_anak">Pilih Tipe Anak <span style="color: red">*</span></label>
                    <select class="form-control js-example-basic-single" id="tipe_anak" name="tipe_anak" required>
                        <option value="">Pilih Tipe Anak</option>
                        <option value="disabilitas">Disabilitas</option>
                        <option value="non_disabilitas">Non Disabilitas</option>
                    </select>
                </div>

                <div class="form-group" id="kebutuhan_disabilitas_id" >
                    <label for="kebutuhan_disabilitas_id">Jenis Kebutuhan Disabilitas</label>
                    <select class="form-control js-example-basic-single" name="kebutuhan_disabilitas_id">
                        <option value="" disabled selected>-- Pilih Jenis Kebutuhan Disabilitas --</option>
                        @foreach ($kebutuhanDisabilitas as $kebutuhanDisabilitasItem)
                            @if ($kebutuhanDisabilitasItem && $kebutuhanDisabilitasItem->jenis_kebutuhan_disabilitas) <!-- Check if the item and its property are not null -->
                                <option value="{{ $kebutuhanDisabilitasItem->id }}">{{ $kebutuhanDisabilitasItem->jenis_kebutuhan_disabilitas }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir <span style="color: red">*</label>
                    <input type="text" class="form-control" name="tempat_lahir" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir <span style="color: red">*</label>
                    <input type="date" class="form-control" name="tanggal_lahir" required>
                </div>
                <div class="form-group">
                    <label for="disukai">Disukai:</label>
                    <textarea class="form-control" name="disukai" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="tidak_disukai">Tidak Disukai:</label>
                    <textarea class="form-control" name="tidak_disukai" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat <span style="color: red">*</label>
                    <input type="text" class="form-control" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="kelebihan">Kelebihan:</label>
                    <textarea class="form-control" name="kelebihan" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="kekurangan">Kekurangan:</label>
                    <textarea class="form-control" name="kekurangan" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="lokasi_id">Tempat Yayasan <span style="color: red">*</label>
                    <select class="form-control js-example-basic-single" id="lokasi_id" name="lokasi_id" required>
                        <option value="" disabled selected>-- Pilih Lokasi --</option>
                        @foreach ($lokasiTugas as $lokasilist)
                        <option value="{{ $lokasilist->id }}">{{ $lokasilist->lokasi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="foto_profil">Foto Profil:</label>
                    <input type="file" class="form-control" name="foto_profil">
                    <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Anda perlu menyertakan jQuery -->

        <script type="text/javascript">
            $(document).ready(function () {
                // Sembunyikan field "Jenis Kebutuhan Disabilitas" saat halaman pertama dimuat
                $('#kebutuhan_disabilitas_id').hide();

                // Tambahkan event listener untuk memantau perubahan pada field "Pilih Tipe Anak"
                $('#tipe_anak').change(function () {
                    var selectedValue = $(this).val();

                    // Jika nilai yang dipilih adalah "disabilitas", maka tampilkan field "Jenis Kebutuhan Disabilitas"
                    if (selectedValue === 'disabilitas') {
                        $('#kebutuhan_disabilitas_id').show();
                    } else {
                        // Jika nilai yang dipilih bukan "disabilitas", maka sembunyikan field "Jenis Kebutuhan Disabilitas"
                        $('#kebutuhan_disabilitas_id').hide();
                    }
                });
            });
        </script>

@endsection
