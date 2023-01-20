@extends('layouts.app')

@section('content')
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('inventario/images/favicon.png') }}">
    <link href="{{ asset('inventario/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('inventario/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/css/bootstrap.min.css" title="main">
    <section class="section">
        <div class="section-header">
            <h3>Estadisticas de Inmuebles y Revaluos</h3>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    Capital invertido en inmuebles
                </div>
                <div class="card-body">
                    {{-- GRÁFICO 1 --}}
                    <div class="container div-principal"
                        style="background-color: rgba(120,106,119,0.1);text-align:center;padding-left:310px">
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-6" width="500">
                                    <div class="container1" id="container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary text-light">
                    Revaluos de inmuebles
                </div>
                <div class="card-body">
                    {{-- GRÁFICO 2 --}}
                    <div class="container div-principal"
                        style="background-color: rgb(120,54,23,0.1);text-align:center;padding-left:310px">
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-6" width="500">
                                    <div class="container3" id="container3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTADOR DE VISITAS -->
    <footer class="card border-left-success border-bottom-secondary">
        <div class="container my-auto">
            <div class="text-center my-auto text-xs font-weight-bold text-ligth text-uppercase mb-1">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                <span>Contador de visitas: {{ $contador_reportes->count }}</span>
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        {{-- GRÁFICO MONTO_X_INMUEBLES --}}
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'center',
                text: 'Presupuesto invertido en la adquisión de inmuebles'
            },
            subtitle: {
                align: 'center',
                text: 'Monto de los activos mostrados en barras'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Monto'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f} Bs'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} Bs</b> de total<br/>'
            },
            series: [{
                name: "Inmueble",
                colorByPoint: true,
                data: <?= $inmueblesData ?> {{-- <?= $inmuebles ?> --}}
            }],
            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: [{
                    name: "Chrome",
                    id: "Chrome",
                    data: [
                        [
                            "pancho",
                            23
                        ]
                    ]
                }, ]
            }
        });

        {{-- GRÁFICO REVALUOS_X_INMUEBLES --}}
        Highcharts.chart('container3', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                align: 'center',
                text: 'Detalles de los activos fijos - revaluos'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: 'Bs.'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y:.1f}'
                    }
                }
            },
            series: [{
                name: 'detallecosto',
                colorByPoint: true,
                data: <?= $revaluosData ?>
            }]
        });
    </script>
@endsection
