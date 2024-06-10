@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tambah Data Sponsor</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('dataSponsor.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="sponsorship_id">Jenis Sponsorship<span style="color: red">*</span></label>
                        <select class="form-control js-example-basic-single" id="sponsorship_id" name="sponsorship_id[]"
                            multiple>
                            @foreach ($sponsorship as $sponsorshipItem)
                                <option value="{{ $sponsorshipItem->id }}"
                                    {{ collect(old('sponsorship_id'))->contains($sponsorshipItem->id) ? 'selected' : '' }}>
                                    {{ $sponsorshipItem->jenis_sponsorship }}
                                </option>
                            @endforeach
                            <option value="lainnya"
                                {{ collect(old('sponsorship_id'))->contains('lainnya') ? 'selected' : '' }}>
                                Pilihan Lainnya
                            </option>
                        </select>

                        <div class="form-group" id="lainnya_div"
                            style="{{ collect(old('sponsorship_id'))->contains('lainnya') ? '' : 'display:none;' }}">
                            <label for="lainnya">Jenis Sponsorship Lainnya</label>
                            <input type="text" class="form-control" id="lainnya" name="lainnya"
                                value="{{ old('lainnya') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_sponsor">Nama Sponsor<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="nama_sponsor" name="nama_sponsor"
                            value="{{ old('nama_sponsor') }}">
                    </div>
                    <div class="form-group">
                        <label for="email_sponsor">Email Sponsor<span style="color: red">*</span></label>
                        <input type="email" class="form-control" id="email_sponsor" name="email_sponsor"
                            value="{{ old('email_sponsor') }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_sponsor">Tanggal Sponsor<span style="color: red">*</span></label>
                        <input type="date" class="form-control" id="tanggal_sponsor" name="tanggal_sponsor"
                            value="{{ old('tanggal_sponsor') }}">
                    </div>
                    <div class="form-group">
                        <label for="no_telepon_sponsor">No. Hp Sponsor</label>
                        <input type="text" class="form-control" id="no_telepon_sponsor" name="no_telepon_sponsor"
                            value="{{ old('no_telepon_sponsor') }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            value="{{ old('deskripsi') }}">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_sponsor">Jumlah Sponsorship</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="height: 100%;">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="jumlah_sponsor" name="jumlah_sponsor"
                                value="{{ old('jumlah_sponsor') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto_sponsor">Foto Sponsor<span style="color: red">*</span></label>
                        <input type="file" class="form-control" id="foto_sponsor" name="foto_sponsor">
                        <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sponsorship_id').change(function() {
                if ($(this).val().indexOf('lainnya') !== -1) {
                    $('#lainnya_div').show();
                } else {
                    $('#lainnya_div').hide();
                }
            }).trigger('change');
        });
    </script>
@endsection
