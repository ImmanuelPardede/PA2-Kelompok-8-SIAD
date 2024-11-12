@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h1 class="card-title">Data Sponsor</h1>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form action="{{ route('dataSponsor.index') }}" method="GET">
                        <div class="form-group">
                            <select class="form-control js-example-basic-single custom-selectDropdown" name="tanggal_sponsor" id="tanggal_sponsor"
                                onchange="this.form.submit()">
                                <option value="" disabled selected>-- Pilih Tahun --</option>
                                @foreach ($tanggalSponsorList as $tanggalSponsor)
                                    <option value="{{ $tanggalSponsor->tahun }}"
                                        {{ request('tanggal_sponsor') == $tanggalSponsor->tahun ? 'selected' : '' }}>
                                        {{ $tanggalSponsor->tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <a href="{{ route('dataSponsor.create') }}" class="btn btn-success mb-3">Tambah Sponsor</a>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Sponsor</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sponsorList as $sponsor)
                                <tr>
                                    <td>{{ $sponsor->nama_sponsor }}</td>
                                    <td>
                                        <a href="{{ route('dataSponsor.show', $sponsor->id) }}"
                                            class="btn btn-info">Detail</a>
                                        <a href="{{ route('dataSponsor.edit', $sponsor->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form method="POST" id="deleteForm{{ $sponsor->id }}" class="d-inline"
                                            action="{{ route('dataSponsor.destroy', $sponsor->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="handleDeleteConfirmation('deleteForm{{ $sponsor->id }}')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Tidak ada Data Sponsor.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                {{ $sponsorList->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
