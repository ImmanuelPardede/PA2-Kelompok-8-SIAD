
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mas Edu Project - Tampil Chart</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style>
        .highcharts-figure,
            .highcharts-data-table table {
                min-width: 310px;
                max-width: 800px;
                margin: 1em auto;
            }

            #container {
                height: 400px;
            }

            .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #ebebeb;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
            }

            .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
            }

            .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
            }

            .highcharts-data-table td,
            .highcharts-data-table th,
            .highcharts-data-table caption {
                padding: 0.5em;
            }

            .highcharts-data-table thead tr,
            .highcharts-data-table tr:nth-child(even) {
                background: #f8f8f8;
            }

            .highcharts-data-table tr:hover {
                background: #f1f7ff;
            }
    </style>
</head>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card mt-5">
                    <div class="card-body">
                    <h3 class="text-center"><img src="https://maseduproject.com/wp-content/uploads/2023/06/cropped-logotrans.png" class="img-fluid"><br>Mas Edu Project</h3>
                        <h3 class="my-4">Grafik Pegawai berdasarkan Jenis Kelamin</h3>

                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>


                    </div>
                </div>
            </div>
        </div>


    <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card mt-5">
                    <div class="card-body">

                        <h3 class="my-4">Grafik Pegawai berdasarkan Divisi</h3>

                        <figure class="highcharts-figure">
                            <div id="containerdivisi"></div>
                        </figure>


                    </div>
                </div>
            </div>
        </div>

    </div>
 <script>
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Pegawai PT NIMCOMLAB TEKNOLOGI INDONESIA',
            align: 'left'
        },
        subtitle: {
            text: 'Tahun 2023',
            align: 'left'
        },
        xAxis: {
            categories: ['Laki-Laki','Perempuan'],
            crosshair: true,
            accessibility: {
            description: 'Jenis Kelamin'
            }
        },
        yAxis: {
            min: 0,
            title: {
            text: 'Orang'
            }
        },
        tooltip: {
            valueSuffix: ' Orang'
        },
        plotOptions: {
            column: {
            pointPadding: 0.2,
            borderWidth: 0
            }
        },
        series: [{
            name: 'Jumlah',
            data: <?=$totaljenkel;?>
            }
        ]
    });


    Highcharts.chart('containerdivisi', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Pegawai PT NIMCOMLAB TEKNOLOGI INDONESIA',
            align: 'left'
        },
        subtitle: {
            text: 'Tahun 2023',
            align: 'left'
        },
        xAxis: {
            categories: <?=$json_divisi;?>,
            crosshair:false,
            accessibility: {
            description: 'Divisi'
            }
        },
        yAxis: {
            min: 0,
            title: {
            text: 'Orang'
            }
        },
        tooltip: {
            valueSuffix: ' Orang'
        },
        plotOptions: {
            column: {
            pointPadding: 0.2,
            borderWidth: 0
            }
        },
        series: <?=$totaldivisi;?>

    });
 </script>
</body>
</html>
