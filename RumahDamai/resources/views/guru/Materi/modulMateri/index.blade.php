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
                    <form action="{{ route('modulMateri.index') }}" method="GET">
                        <div class="form-group">
                            <select class="form-control js-example-basic-single" name="tahun_ajaran_id" id="tahun_ajaran_id" onchange="this.form.submit()">
                                <option value="" disabled selected>-- Pilih Tahun Ajaran --</option>
                                @foreach($tahunAjaranList as $tahunAjaran)
                                <option value="{{ $tahunAjaran->id }}" {{ request('tahun_ajaran_id') == $tahunAjaran->id ? 'selected' : '' }}>
                                    {{ $tahunAjaran->tahun_ajaran }} <!-- Adjust this to match the attribute in your model -->
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
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
                                        <a href="{{ route('modulMateri.show', $modulMateri->id) }}" class="btn btn-info">Detail</a>
                                        <a href="{{ route('modulMateri.edit', $modulMateri->id) }}" class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $modulMateri->id }}" class="d-inline" action="{{ route('modulMateri.destroy', $modulMateri->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="handleDeleteConfirmation('deleteForm{{ $modulMateri->id }}')">
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
