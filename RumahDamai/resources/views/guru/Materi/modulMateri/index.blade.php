@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h1 class="card-title head-data">Nama Materi</h1>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex">
                        <!-- Filter Tahun Ajaran -->
                        <form action="{{ route('modulMateri.index') }}" method="GET" class="mx-1">
                            <div class="form-group">
                                <!-- Dropdown Tahun Ajaran -->
                                <select class="form-control js-example-basic-single custom-selectDropdown"
                                    name="tahun_ajaran_id" id="tahun_ajaran_id" onchange="this.form.submit()">
                                    <option value="" disabled {{ !request('tahun_ajaran_id') ? 'selected' : '' }}>-- Pilih Tahun Ajaran --</option>
                                    @foreach ($tahunAjaranList as $tahunAjaran)
                                        <option value="{{ $tahunAjaran->id }}"
                                            {{ request('tahun_ajaran_id') == $tahunAjaran->id ? 'selected' : '' }}>
                                            {{ $tahunAjaran->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <!-- Filter Minggu Pembelajaran (tanpa mereset Tahun Ajaran) -->
                        <form action="{{ route('modulMateri.index') }}" method="GET" class="mx-1">
                            <div class="form-group">
                                <!-- Hidden field to keep the selected Tahun Ajaran when Minggu Pembelajaran is chosen -->
                                <input type="hidden" name="tahun_ajaran_id" value="{{ request('tahun_ajaran_id') }}">

                                <!-- Dropdown Minggu Pembelajaran -->
                                <select class="form-control js-example-basic-single custom-selectDropdown"
                                    name="minggu_pembelajaran_id" id="minggu_pembelajaran_id" onchange="this.form.submit()">
                                    <option value="" disabled {{ !request('minggu_pembelajaran_id') ? 'selected' : '' }}>-- Pilih Minggu Pembelajaran --</option>
                                    @foreach ($mingguPembelajaranList as $mingguPembelajaran)
                                        <option value="{{ $mingguPembelajaran->id }}"
                                            {{ request('minggu_pembelajaran_id') == $mingguPembelajaran->id ? 'selected' : '' }}>
                                            {{ $mingguPembelajaran->minggu_pembelajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('modulMateri.create') }}" class="btn btn-success mb-3">Tambah Modul Materi</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Nama Materi</th>
                                <th scope="col">Modul Minggu</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($modulMateriList as $modulMateri)
                                <tr>
                                    <td>{{ $modulMateri->nama_materi }}</td>
                                    <td>{{ $modulMateri->mingguPembelajaran->minggu_pembelajaran }}</td>
                                    <td>
                                        <a href="{{ route('modulMateri.show', $modulMateri->id) }}"
                                            class="btn btn-info">Detail</a>
                                        <a href="{{ route('modulMateri.edit', $modulMateri->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $modulMateri->id }}" class="d-inline"
                                            action="{{ route('modulMateri.destroy', $modulMateri->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $modulMateri->id }}')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada Modul Materi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                {{ $modulMateriList->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
