@extends('layouts.management.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="card-title">Jadwal Pembelajaran</h4>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="125">Time</th>
                                @foreach ($weekDays as $day)
                                    <th>{{ $day }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($calendarData) && count($calendarData) > 0)
                                @foreach ($calendarData as $time => $days)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse(explode(' - ', $time)[0])->format('H:i') }} -
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
                            @else
                                <tr>
                                    <td colspan="{{ count($weekDays) + 1 }}" class="text-center">Tidak ada data
                                        jadwal pembelajaran tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
