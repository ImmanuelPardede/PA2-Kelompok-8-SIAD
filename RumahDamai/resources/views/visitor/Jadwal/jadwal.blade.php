@extends('layouts.visitors.master')

<style>
    /* Gaya CSS untuk dropdown dan tabel */
    .table-fixed {
        table-layout: fixed;
        width: 100%;
    }

    .table-fixed th {
        width: 70%;
        height: 50px;
        background-color: #3f5a77;
        color: white;
        text-align: center;
    }

    .table-fixed td {
        width: 150px;
        height: 150px;
        background-color: #fff;
        text-align: center;
        vertical-align: middle;
    }

    .table-fixed td.special {
        background-color: lightblue;
        padding: 5px;
    }

    .table-fixed td.special div {
        margin-bottom: 5px;
    }

    .table-fixed th {
        color: #fff;

    }

    .table-fixed td {
        color: #000;
    }

    .bg-primary {
        background-color: #5394da !important;
        color: #fff;
    }

    /* Custom Dropdown Styles */
    .custom-dropdown .dropdown-menu {
        display: none;
        flex-direction: row;
        flex-wrap: wrap;
        padding: 20px 20px 20px 20px;
        width: auto;
        max-width: 100%;
        position: absolute;
        z-index: 1000;
    }

    .custom-dropdown .dropdown-item-container {
        display: flex;
        flex-direction: column;
    }

    .custom-dropdown .dropdown-item {
        margin-bottom: 5px;
    }

    .custom-dropdown .dropdown-item:hover {
        background-color: #f0f0f0;
    }

    .custom-dropdown .dropdown-item-desc {
        font-size: 14px;
        color: #000;
    }

    /* Gaya tambahan untuk mengatur teks di tengah */
    .text-center {
        text-align: center;
        color: #000;

    }

    /* Gaya untuk tombol dropdown */
    .custom-dropdown .btn-secondary {
        background-color: #fff;
        color: #000;
        border: none;
    }
</style>

@section('content')
    <section class="news-detail-header-section text-center">
        <!-- Header section code -->
    </section>

    <section class="section-padding">
        <div class="content">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="dropdown custom-dropdown">
                                <button class="btn btn-secondary dropdown-toggle text-center" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Pilih Lokasi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($lokasiPenugasan as $index => $lokasi)
                                        @if ($index % 2 == 0)
                                            <div class="dropdown-item-container">
                                        @endif
                                        <a href="#" class="dropdown-item"
                                            onclick="selectLokasi('{{ $lokasi->id }}')">{{ $lokasi->lokasi }}
                                            <p class="dropdown-item-desc">{{ $lokasi->deskripsi }}</p>
                                        </a>
                                        @if ($index % 2 == 1 || $loop->last)
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @foreach ($calendarData as $lokasiId => $calendar)
                        <div class="table-responsive mb-4 lokasi-table" data-lokasi-id="{{ $lokasiId }}"
                            style="{{ $lokasiId == $lokasiPenugasanId ? '' : 'display:none;' }}">
                            <p class="text-center">Jadwal Pembelajaran di Yayasan Rumah Damai<br>
                                {{ $lokasiPenugasan->firstWhere('id', $lokasiId)->lokasi }}</p>
                            <table class="table table-bordered table-fixed">
                                <thead class="bg-primary">
                                    <tr>
                                        <th width="200">Time</th>
                                        @foreach ($weekDays as $day)
                                            <th>{{ $day }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calendar as $time => $days)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse(explode(' - ', $time)[0])->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse(explode(' - ', $time)[1])->format('H:i') }}</td>
                                            @foreach ($weekDays as $day)
                                                @if (isset($days[$day]))
                                                    <td class="align-middle text-center special"
                                                        style="background-color: {{ $days[$day]['color'] ?? '#ffffff' }}">
                                                        @if ($days[$day]['time_start'] != '-')
                                                            <div>
                                                                {{ $days[$day]['kelas'] }}<br>
                                                            </div>
                                                        @else
                                                            ....
                                                        @endif
                                                    </td>
                                                @else
                                                    <td class="special">....</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();

            $('.custom-dropdown .dropdown-toggle').click(function(e) {
                e.stopPropagation();
                var dropdownMenu = $(this).next('.dropdown-menu');
                $('.custom-dropdown .dropdown-menu').not(dropdownMenu).hide();
                dropdownMenu.toggle();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.custom-dropdown').length) {
                    $('.custom-dropdown .dropdown-menu').hide();
                }
            });

            // Menambahkan kondisi untuk menampilkan dropdown hanya jika kursor berada di area dropdown
            $('.custom-dropdown').on('mouseenter', function() {
                $(this).find('.dropdown-menu').show();
            }).on('mouseleave', function() {
                $(this).find('.dropdown-menu').hide();
            });
        });

        function selectLokasi(id) {
            // Menyembunyikan semua tabel jadwal pembelajaran
            $('.lokasi-table').hide();

            // Menampilkan tabel jadwal pembelajaran yang sesuai dengan lokasi yang dipilih
            $('.lokasi-table[data-lokasi-id="' + id + '"]').show();

            // Menampilkan teks informasi di atas tabel jadwal pembelajaran yang sesuai
            var lokasiText = $('.lokasi-table[data-lokasi-id="' + id + '"]').find('.text-center').text();
            $('.selected-lokasi-info').text(lokasiText);
        }
    </script>
@endsection
