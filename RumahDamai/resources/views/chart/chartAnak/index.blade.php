<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Highcharts Scripts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- Axios Library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .chart-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .highcharts-figure {
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .chart-card {
                min-height: 250px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card mt-5 chart-card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card mt-5 chart-card">
                            <div class="card-body">
                                <h3 class="card-title text-center">Grafik Data Anak</h3>
                                <figure class="highcharts-figure">
                                    <div id="container"></div>
                                </figure>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card mt-5 chart-card">
                            <div class="card-body">
                                <h3 class="card-title text-center">Grafik Data Anak per Divisi</h3>
                                <figure class="highcharts-figure">
                                    <div id="containerdivisi"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var currentYear = {!! json_encode(date('Y')) !!}; // Mengambil tahun sekarang dari PHP

        // Fungsi untuk merender chart berdasarkan tipe yang dipilih
        function renderCharts(chartType) {
            if (chartType === 'year') {
                // Render chart tahun
                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Data Anak',
                        align: 'left'
                    },
                    subtitle: {
                        text: 'Tahun ' + currentYear,
                        align: 'left'
                    },
                    xAxis: {
                        categories: {!! json_encode(array_unique(array_keys($totalAnakStatus))) !!},
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Anak'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' Anak',
                        shared: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                            name: 'Aktif',
                            data: [{!! $totalAnakStatus['aktif'] !!}]
                        },
                        {
                            name: 'Tidak Aktif',
                            data: [{!! $totalAnakStatus['tidak_aktif'] !!}]
                        }
                    ]
                });

                Highcharts.chart('containerdivisi', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Data Anak',
                        align: 'left'
                    },
                    subtitle: {
                        text: 'Tahun ' + currentYear,
                        align: 'left'
                    },
                    xAxis: {
                        categories: {!! json_encode(array_unique($json_tipeanak['tipe_anak'])) !!},
                        crosshair: false
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Anak'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' Anak',
                        shared: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                            name: 'Disabilitas',
                            data: [{!! $totalAnakStatus['aktif'] !!}]
                        },
                        {
                            name: 'Non Disabilitas',
                            data: [{!! $totalAnakStatus['tidak_aktif'] !!}]
                        }
                    ]
                });
            }
        }

        renderCharts('year');
    </script>
</body>

</html>
