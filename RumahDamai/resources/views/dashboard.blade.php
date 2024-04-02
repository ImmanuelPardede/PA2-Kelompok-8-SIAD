@extends('layouts.master')

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

          
                  @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
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

            <h5 id="pengumuman" class="card-title mb-4">Pengumuman</h5>
            @if(Auth::user()->role == 'admin')

            <div class="mb-3 ml-auto">

              <a href="{{ route('pengumuman.create') }}" class="btn btn-primary">Create Pengumuman</a>
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
