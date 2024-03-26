@extends('layouts.master')

@section('content')
<div class="container">

<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Haloo {{ Auth::user()->name }}</h3>
          <h6 class="font-weight-normal mb-0">Hari ini Sistem Berjalan Dengan Baik! Kamu memiliki <span class="text-primary">3 To-doList yang belum kamu kerjakan!</span></h6>
        </div>
        <div class="col-12 col-xl-4">
         <div class="justify-content-end d-flex">
<button class="btn btn-sm btn-light bg-white" type="button" aria-haspopup="true" aria-expanded="true">
    <?php echo date('l, d F Y'); ?>
</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin transparent">
    <div class="row">
      <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">Pegawai</p>
            <p class="fs-30 mb-2">{{ $totalPegawai }}</p>
            <p>Terdata, Sejak Dibuat Sistem Ini</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">Anak</p>
            <p class="fs-30 mb-2">61344</p>
            <p>Terdata, Sejak Dibuat Sistem Ini</p>
          </div>
        </div>
    </div>
    <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Materi</p>
            <p class="fs-30 mb-2">34040</p>
            <p>Terdata, Sejak Dibuat Sistem Ini</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">Donatur Dalam Angkah</p>
            <p class="fs-30 mb-2">47033</p>
            <p>Terdata, Sejak Dibuat Sistem Ini</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-7 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            @if(Auth::user()->role == 'admin')

            <h5 class="card-title mb-4">Pengumuman</h5>
            <div class="mb-3 ml-auto">
              <a href="{{ route('pengumuman.create') }}" class="btn btn-primary">Create Pengumuman</a>
                </div>
          </div>
          @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Dibuat</th>
                            <th>Status</th>
                            @if(Auth::user()->role == 'admin')

                            <th>Aksi</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengumumans as $pengumuman)
                        <tr>
                            <td><a href="{{ route('pengumuman.show', ['id' => $pengumuman->id]) }}">{{ $pengumuman->judul }}</a></td>
                            <td>{{ $pengumuman->created_at->format('d/m/Y H:i') }}</td>
                            <!-- Tambahkan logika status di sini -->
                            <td>Status</td>
                            <!-- Dropdown menu untuk aksi -->
                            @if(Auth::user()->role == 'admin')

                            <td>
                              
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('pengumuman.edit', ['id' => $pengumuman->id]) }}">Edit</a>
                                        <form action="{{ route('pengumuman.destroy', ['id' => $pengumuman->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    </div>
    <div class="col-md-5 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">To Do Lists</h4>
                            <div class="list-wrapper pt-2">
                                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                    <li>
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox">
                                                Oke
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                    <li class="">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox" checked>
                                                Oke gass
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                    <li>
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox">
                                                Oke Gass
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                    <li class="">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox" checked>
                                                Oke Gass
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                    <li>
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox">
                                                oke Gass
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                </ul>
          </div>
          <div class="add-items d-flex mb-0 mt-2">
                                <input type="text" class="form-control todo-list-input"  placeholder="Tambahkan">
                                <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="icon-circle-plus"></i></button>
                            </div>
                        </div>
                    </div>
    </div>
  </div>


</div>
@endsection
