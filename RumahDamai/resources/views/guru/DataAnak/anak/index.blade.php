@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h1 class="card-title head-data">Data Anak</h1>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('guru.anak.export.excel') }}" class="btn btn-primary mr-auto">Export to Excel</a>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" id="search" name="search"
                            placeholder="Cari..." aria-label="Search">
                    </form>
                </div>

                <div id="results" class="table-responsive mt-3">
                    @include('guru.DataAnak.anak._table', ['anakList' => $anakList])
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                {{ $anakList->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('search');
        const resultsContainer = document.getElementById('results');

        // Event listener untuk keyup di kolom pencarian
        searchInput.addEventListener('keyup', function() {
            let query = this.value;

            // Cek apakah kueri tidak kosong
            if (query) {
                fetch(`{{ route('guru.anak.index') }}?search=${query}`, {
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
                        resultsContainer.innerHTML = data; // Perbarui hasil
                    })
                    .catch(error => {
                        console.error('Ada masalah dengan operasi fetch:', error);
                    });
            } else {
                // Jika kueri kosong, kirim permintaan untuk mendapatkan data awal
                fetch(`{{ route('guru.anak.index') }}`, {
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
                        resultsContainer.innerHTML = data; // Tampilkan data awal
                    })
                    .catch(error => {
                        console.error('Ada masalah dengan operasi fetch:', error);
                    });
            }
        });

        // Cegah pengiriman form saat menekan Enter
        searchInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Cegah pengiriman form
            }
        });
    </script>
@endsection
