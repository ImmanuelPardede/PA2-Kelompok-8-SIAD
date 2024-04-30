@extends('layouts.visitors.master')

@section('content')
    <section class="news-detail-header-section text-center">
        <div class="section-overlay"></div>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12">
                    <h1 class="text-white">Jadwal Pembelajaran</h1>
                </div>

            </div>
        </div>
    </section>


    <section class="section-padding section-bg" id="section_2">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="custom-text-box cursor-pointer img-with-shadow">
                            <h4 class="mb-2">Kalender</h4>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-bordered table-fixed">
                                        <thead class="site-header text-white ">
                                            <tr>
                                                <th width="125">Time</th>
                                                @foreach ($weekDays as $day)
                                                    <th>{{ $day }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($calendarData as $time => $days)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse(explode(' - ', $time)[0])->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse(explode(' - ', $time)[1])->format('H:i') }}
                                                    </td>
                                                    @foreach ($weekDays as $day)
                                                        @if (isset($days[$day]))
                                                            <td class="align-middle text-center special"
                                                                style="background-color: {{ $days[$day]['color'] ?? '#ffffff' }}">
                                                                @if ($days[$day]['time_start'] != '-')
                                                                    <div>
                                                                        {{ $days[$day]['guru'] }}<br>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
