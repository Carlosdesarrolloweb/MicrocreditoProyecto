@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black; font-size: 6em;">BIENVENID@</h1>
<center>
    <h1 style="text-align: center;font-weight: bold; color: red;"> {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</h1>
 </center>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop

@section('content')

        <body style="background-color: white;">
             <div class="row">
                <div class="col-lg-3 mb-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $cantidad_clientes }}</h3>
                            <p>Clientes creados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $cantidad_clientes_con_prestamo }}</h3>
                            <p>Clientes con préstamo</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $cantidad_garantias }}</h3>
                            <p>Garantías Registradas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-lg-9" >
                    <div class="card">
                        <div class="card-body"style="background-color: #75606069;">
                            <canvas id="prestamoChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-lg-9" >
                    <div class="card">
                        <div class="card-body" style="background-color: #75606069;">
                            <canvas id="pagosChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </body>

@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>
        .container {
         margin-top: 80px;
        }
        .row {
        padding-left: 250px;
        }
        .col-lg-4 {
        padding-left: 15px;
        padding-right: 15px;
        }

    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src= "{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>


        // Obtener los datos de 'prestamo' a través de una ruta de Laravel
        const url = "{{ route('obtener_datos_prestamo') }}";

        // Realizar una petición AJAX para obtener los datos de 'prestamo'
        // y configurar el gráfico cuando los datos estén disponibles
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.fecha_prestamo);
                const montosPrestados = data.map(item => item.total_monto_prestado);

                const chartData = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Prestamos por dia',
                            data: montosPrestados,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            type: 'bar'
                        }
                    ]
                };

                const ctx = document.getElementById('prestamoChart').getContext('2d');
                const prestamoChart = new Chart(ctx, {
                    type: 'bar',
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error(error));
    </script>
    <script>
        fetch('{{ route("obtener_datos_pagos_grafico") }}')
            .then(response => response.json())
            .then(datosPagos => {
                const labels = datosPagos.map(datoPago => datoPago.fecha_pago);
                const montosPagados = datosPagos.map(datoPago => datoPago.total_monto_pago);

                const ctx = document.getElementById('pagosChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total de Pagos por Día',
                            data: montosPagados,
                            pointStyle: 'circle',
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });
    </script>
@stop







