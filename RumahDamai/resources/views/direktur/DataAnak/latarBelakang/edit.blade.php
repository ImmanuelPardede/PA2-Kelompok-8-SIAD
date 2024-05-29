@extends('layouts.management.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Latar Belakang Anak</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        Terdapat kesalahan saat validasi data. Mohon periksa kembali.
                    </div>
                @endif

                <form id="editForm" action="{{ route('direktur.latarBelakang.update', $latarBelakang->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="anak_id">Nama</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                            value="{{ $latarBelakang->anak->nama_lengkap }}" readonly>
                        <input type="hidden" id="anak_id" name="anak_id" value="{{ $latarBelakang->anak->id }}">
                    </div>

                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <input type="number" class="form-control" id="usia" name="usia"
                            value="{{ $latarBelakang->usia }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas"
                            value="{{ $latarBelakang->kelas }}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ $latarBelakang->tanggal }}">
                    </div>

                    <div id="gambar_latar_belakang_wrapper">
                        <!-- Elemen gambar dan deskripsi yang sudah ada -->
                        @foreach ($latarBelakang->gambarLatarBelakang ?? [] as $index => $gambar)
                            <div class="form-group" id="gambar_latar_belakang_group_{{ $index }}">
                                <label for="gambar_latar_belakang_{{ $index }}">Gambar Latar Belakang</label>
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ asset('storage/uploads/gambar_latar_belakang/' . $gambar->nama) }}"
                                        alt="Gambar Latar Belakang" class="img-thumbnail"
                                        style="width: 200px; height: 200px; object-fit: cover;">
                                    <input type="file" class="form-control ml-3"
                                        id="gambar_latar_belakang_{{ $index }}" name="gambar_latar_belakang[]"
                                        accept="image/*">
                                    <input type="hidden" name="existing_image_ids[]" value="{{ $gambar->id }}">
                                    <button type="button" class="btn btn-danger ml-2"
                                        onclick="hapusGambarDanDeskripsi({{ $index }}, {{ $gambar->id }})">Hapus</button>
                                    <input type="hidden" name="deleted_images[]" id="deleted_image_{{ $index }}"
                                        value="">
                                </div>
                                <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
                            </div>
                            <div class="form-group mb-3" id="deskripsi_group_{{ $index }}">
                                <label for="deskripsi_{{ $index }}" class="form-label">Deskripsi<span
                                        style="color: red">*</span></label>
                                <textarea id="deskripsi_{{ $index }}" class="form-control" name="deskripsi[]" autocomplete="deskripsi">{{ $latarBelakang->deskripsiLatarBelakang[$index]->deskripsi ?? '' }}</textarea>
                                <span class="invalid-feedback" role="alert" id="deskripsi-error-{{ $index }}"
                                    style="display: none;">
                                    <strong></strong>
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div style="form-group d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Batal</a>
                        <!-- Tombol submit untuk menyimpan perubahan -->
                        <button type="submit" id="submitButton" class="btn btn-success">Perbaharui</button>
                        <div style="float: right;">
                            <button type="button" class="btn btn-primary" onclick="tambahGambarDanDeskripsi()">Tambah
                                Gambar &
                                Deskripsi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let counter = {{ count($latarBelakang->gambarLatarBelakang) }};
    let deletedImageIds = [];

    function tambahGambarDanDeskripsi() {
        counter++;
        let newGambarLatarBelakang = `
            <div class="form-group" id="gambar_latar_belakang_group_${counter}">
                <label for="gambar_latar_belakang_${counter}">Gambar Latar Belakang</label>
                <div class="d-flex align-items-center mb-2">
                    <input type="file" class="form-control" id="gambar_latar_belakang_${counter}" name="gambar_latar_belakang[]" accept="image/*" required>
                    <button type="button" class="btn btn-danger ml-2" onclick="hapusGambarDanDeskripsi(${counter})">Hapus</button>
                </div>
                <small class="text-muted">Jenis file yang diizinkan: JPG, JPEG, PNG.</small>
            </div>
        `;
        let newDeskripsi = `
            <div class="form-group mb-3" id="deskripsi_group_${counter}">
                <label for="deskripsi_${counter}" class="form-label">Deskripsi<span style="color: red">*</span></label>
                <textarea id="deskripsi_${counter}" class="form-control" name="deskripsi[]" required autocomplete="deskripsi"></textarea>
                <span class="invalid-feedback" role="alert" id="deskripsi-error-${counter}" style="display: none;">
                    <strong></strong>
                </span>
            </div>
        `;
        document.getElementById('gambar_latar_belakang_wrapper').insertAdjacentHTML('beforeend',
        newGambarLatarBelakang);
        document.getElementById('gambar_latar_belakang_wrapper').insertAdjacentHTML('beforeend', newDeskripsi);

        // Initialize CKEditor for the new textarea
        ClassicEditor
            .create(document.querySelector(`#deskripsi_${counter}`), {
                // CKEditor 5 configuration for the new textarea
            })
            .catch(error => {
                console.error('Error initializing CKEditor 5:', error);
            });
    }

    function hapusGambarDanDeskripsi(index, imageId = null) {
        if (index > 0) {
            document.getElementById(`gambar_latar_belakang_group_${index}`).remove();
            document.getElementById(`deskripsi_group_${index}`).remove();
            if (imageId) {
                deletedImageIds.push(imageId);
                document.getElementById('editForm').insertAdjacentHTML('beforeend',
                    `<input type="hidden" name="deleted_images[]" value="${imageId}">`);
            }
        } else {
            alert('Tidak dapat menghapus elemen pertama.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor for existing textareas
        document.querySelectorAll('textarea[name="deskripsi[]"]').forEach(textarea => {
            ClassicEditor
                .create(textarea, {
                    // CKEditor 5 configuration for existing textareas
                })
                .catch(error => {
                    console.error('Error initializing CKEditor 5:', error);
                });
        });

        // Handle form submission
        const submitButton = document.getElementById('submitButton');
        submitButton.addEventListener('click', function() {
            // Submit the form when the button is clicked
            document.getElementById('editForm').submit();
        });
    });
</script>
