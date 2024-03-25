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
            <p class="fs-30 mb-2">4006</p>
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
          <p class="card-title mb-0">Pengumuman</p>
          <div class="table-responsive">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>Judul</th>
                  <th>Dibuat</th>
                  <th>Pada</th>
                  <th>Status</th>
                </tr>  
              </thead>

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


  
  <div class="container mt-5">
    <h2>Todo List</h2>
    <div class="row">
        <div class="col-md-6">
            <form id="addTaskForm">
                <div class="form-group">
                    <label for="task">Task:</label>
                    <input type="text" class="form-control" id="task" name="task" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>
    </div>
    <hr>
    <ul id="todoList" class="list-group">
        <!-- Todo list items will be dynamically added here -->
    </ul>
</div>

</div>

<script>
  $(document).ready(function(){
      // Function to fetch and display todo list
      function fetchTodoList() {
          $.get('/api/todolist', function(data){
              $('#todoList').empty();
              $.each(data, function(index, todo){
                  $('#todoList').append(`
                      <li class="list-group-item">
                          <input type="checkbox" class="form-check-input" id="todo_${todo.id}" ${todo.completed ? 'checked' : ''}>
                          <label class="form-check-label ${todo.completed ? 'completed' : ''}" for="todo_${todo.id}">${todo.task}</label>
                          <button type="button" class="btn btn-danger btn-sm float-right delete-btn" data-id="${todo.id}">Delete</button>
                      </li>
                  `);
              });
          });
      }

      // Initial fetch of todo list
      fetchTodoList();

      // Add task form submission
      $('#addTaskForm').submit(function(event){
          event.preventDefault();
          var task = $('#task').val();

          $.post('/api/todolist', {task: task}, function(data){
              fetchTodoList();
              $('#task').val('');
          });
      });

      // Update task completion status
      $('#todoList').on('change', 'input[type="checkbox"]', function(){
          var id = $(this).attr('id').split('_')[1];
          var completed = $(this).prop('checked');

          $.ajax({
              url: `/api/todolist/${id}`,
              type: 'PUT',
              data: {completed: completed},
              success: function(){
                  fetchTodoList();
              }
          });
      });

      // Delete task
      $('#todoList').on('click', '.delete-btn', function(){
          var id = $(this).data('id');

          $.ajax({
              url: `/api/todolist/${id}`,
              type: 'DELETE',
              success: function(){
                  fetchTodoList();
              }
          });
      });
  });
</script>
@endsection
