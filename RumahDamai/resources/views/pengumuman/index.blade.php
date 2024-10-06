@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title d-flex justify-content-between align-items-center">
                    Daftar Pengumuman
                    {{-- <input type="text" id="search" class="form-control" placeholder="Cari..." aria-label="Search"> --}}
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" id="search" name="search" placeholder="Cari..." aria-label="Search">
                    </form>
                </h1>

                <div id="results" class="table-responsive">
                    @include('pengumuman._table', ['pengumumans' => $pengumumans])
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end justify-content-md-end justify-content-center">
                                {{ $pengumumans->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let query = this.value;
            fetch(`{{ route('menampilkanPengumuman.index') }}?search=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('results').innerHTML = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    </script>
@endsection
