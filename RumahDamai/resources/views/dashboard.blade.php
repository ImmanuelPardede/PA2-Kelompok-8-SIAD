@extends('layouts.management.master')

@section('content')
<style>
  .btn-add {
    border: none;
    background: none;
    padding: 0;
    cursor: pointer;
}



</style>

<div class="container">

<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Haloo {{ Auth::user()->name }}</h3>
          @php
          $userTasks = $todolist->where('user_id', Auth::id());
          $totalUserTasks = $userTasks->count();
          @endphp
          
          <h6 class="font-weight-normal mb-0">
              Hari ini Sistem Berjalan Dengan Baik!
              @if($totalUserTasks > 0) 
          <a href="#todo"> <span class="text-primary">
            Kamu memiliki <span class="text-danger">{{ $totalUserTasks }}</span> To-doList yang belum kamu kerjakan!</span></a>

                 
              @else
                  Selamat bekerja!
              @endif
          </h6>


          @if (!Auth::user()->isProfileComplete() && Auth::user()->role !== 'admin')
    <div class="container mt-4">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Data diri kamu belum lengkap. Silahkan lengkapi!
            <ul class="mt-2 mb-0">
                @foreach(Auth::user()->missingProfileFields() as $field)
                    <li>{{ $field }}</li>
                @endforeach
            </ul>
            @if(Auth::user()->role === 'guru' || Auth::user()->role === 'staff' || Auth::user()->role === 'direktur' )
            <a href="{{ Auth::user()->role === 'guru' ? route('guru.DataDiri.edit', ['user' => Auth::user()]) : (Auth::user()->role === 'staff' ? route('staff.DataDiri.edit', ['user' => Auth::user()]) : route('direktur.DataDiri.edit', ['user' => Auth::user()])) }}" class="mt-2">Edit Data Diri</a>
        @endif
        
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif


      


          
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

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

  {{--  --}}
  @php
  $allowedRoles = ['staff', 'admin', 'guru'];
@endphp
@if (in_array(auth()->user()->role, $allowedRoles))

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
            <p class="fs-30 mb-2">{{ $totalanak }}</p>
            <p>Terdata, Sejak Dibuat Sistem Ini</p>
          </div>
        </div>
    </div>
    <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Materi</p>
            <p class="fs-30 mb-2">{{ $totalmateri }}</p>
            <p>Terdata, Sejak Dibuat Sistem Ini</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">Donatur Dalam Angkah</p>
            <p class="fs-30 mb-2">{{ $totoldonatur }}</p>
            <p>Terdata, Sejak Dibuat Sistem Ini</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endif
  
  {{--  --}}


  {{-- direktur --}}
  @auth
  @if (auth()->user()->role === 'direktur')
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card position-relative">
        <div class="card-body">
          <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                    <div class="ml-xl-4 mt-3">
                    <p class="card-title">Anak Dalam Angka</p>
                      <h1 class="text-primary">-</h1>
                      <p class="mb-2 mb-xl-0">Data Jumlah anak yang masuk kedalam Yayasan Pendidikan Anak dalam bentuk angka</p>
                    </div>  
                    </div>
                  <div class="col-md-12 col-xl-9">
                    <div class="row">
                      <div class="col-md-6 border-right">
                        <div class="table-responsive mb-3 mb-md-0 mt-3">
                          <table class="table table-borderless report-table">
                            <tr>
                              <td class="text-muted">Illinois</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">713</h5></td>
                            </tr>
                            
                          </table>
                        </div>
                      </div>
                      <div class="col-md-6 mt-5">
                        <canvas id="barChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="carousel-item">
                <div class="row">
                  <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                    <div class="ml-xl-4 mt-3">
                    <p class="card-title">Detailed Reports</p>
                      <h1 class="text-primary">$34040</h1>
                      <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                      <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                    </div>  
                    </div>
                  <div class="col-md-12 col-xl-9">
                    <div class="row">
                      <div class="col-md-6 border-right">
                        <div class="table-responsive mb-3 mb-md-0 mt-3">
                          <table class="table table-borderless report-table">
                            <tr>
                              <td class="text-muted">Illinois</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">713</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">Washington</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">583</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">Mississippi</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">924</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">California</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">664</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">Maryland</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">560</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">Alaska</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">793</h5></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-6 mt-3">
                        <canvas id="south-america-chart"></canvas>
                        <div id="south-america-legend"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> --}}
            </div>
            <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
      @endif
      @endauth

  {{-- end direktur --}}

  <div class="row">
    <div class="col-md-7 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">

            <h5 id="pengumuman" class="card-title mb-4">Pengumuman</h5>
            @if(Auth::user()->role == 'admin')

            <div class="mb-3 ml-auto">

              <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">Create Pengumuman</a>
            </div>
          @endif

          @if(Auth::user()->role == 'direktur')

          <div class="mb-3 ml-auto">

            <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">Create Pengumuman</a>
          </div>
        @endif
        </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            @if(Auth::user()->role == 'admin')
                            <th>Aksi</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengumumans as $pengumuman)
                        <tr>
                          <td>
                            @if(!$pengumuman->isReadByUser(Auth::id()))
                                <i class="fas fa-exclamation-circle text-danger"></i>
                            @endif
                            <a href="{{ route('pengumuman.show', ['id' => $pengumuman->id]) }}"><span class="text-primary">[{{ $pengumuman->kategori }}]</span>
                                @if(Auth::user()->role == 'admin') <!-- Admin -->
                                    {!! Str::limit($pengumuman->judul, 40) !!}
                                @else
                                    {!! Str::limit($pengumuman->judul, 60) !!}
                                @endif
                            </a>
                        </td>
                        

                          @if(Auth::user()->role == 'admin')
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('admin.pengumuman.edit', ['id' => $pengumuman->id]) }}">Edit</a>
                                        <form action="{{ route('admin.pengumuman.destroy', ['id' => $pengumuman->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            @endif

                            @if(Auth::user()->role == 'direktur')
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('admin.pengumuman.edit', ['id' => $pengumuman->id]) }}">Edit</a>
                                        <form action="{{ route('admin.pengumuman.destroy', ['id' => $pengumuman->id]) }}" method="POST">
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
            <div>
              <h5 class="card-title mb-4" id="todo">Todolist</h5>
              <div class="list-wrapper pt-2">

                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                  @foreach($todolist->where('user_id', Auth::id()) as $task)
                  <li>
                      <div class="form-check form-check-flat">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox" 
                          onchange="updateStatus({{ $task->id }}, this.checked)" 
                          {{ $task->status === 'selesai' ? 'checked' : '' }}>
                          {{ $task->tugas }}
                      </label>
                      
                      
                      </div>
                      <form method="post" action="{{ route('todo.destroy', $task->id) }}" style="display: inline;">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-link"><i class="remove ti-close"></i></button>
                    </form>

                  </li>
                    @endforeach
                </ul>
            </div>
            </div>
            <div class="add-task">
              <form method="post" action="{{ route('todo.store') }}">
                  @csrf
                  <div class="input-group">
                      <input type="text" name="tugas" class="form-control input-task border-0 bg-transparent" placeholder="Tambahkan Todolist anda !" style="outline: none;">
                      <div class="input-group-append">
                          <button type="submit" class="btn btn-add">
                              <i class="icon-circle-plus"></i>
                          </button>
                      </div>
                  </div>
              </form>
          </div>
          
        </div>
    </div>
</div>






  </div>
</div>
</div>
</div>

<script>
  function updateStatus(taskId, checked) {
      // Buat objek FormData untuk mengirim data
      var formData = new FormData();
      formData.append('_token', '{{ csrf_token() }}'); // Tambahkan CSRF token
      formData.append('status', checked ? 'selesai' : 'menunggu'); // Tentukan status baru

      // Kirim permintaan POST ke endpoint edit
      fetch(`/todo/${taskId}/edit`, {
          method: 'POST',
          body: formData
      })
      .then(response => {
          if (response.ok) {
              console.log('Task status updated successfully.');
              // Refresh halaman
              location.reload();
          } else {
              console.error('Failed to update task status.');
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
  }
</script>



        
@endsection
