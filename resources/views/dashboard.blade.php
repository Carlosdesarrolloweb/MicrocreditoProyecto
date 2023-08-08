@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="logo-container">
    <img class="logo" src="{{ asset('logomicrocreditosmary.png') }}" alt="Logo Microcréditos Mary">
    <h1 style="text-align: center; font-weight: bold; color: black; font-size: 4em; margin-bottom: -5;">MICROCREDITOS MARY</h1>
</div>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop
@section('content')
<div class="custom-container">
    <body style="background-color: white; padding-left: 20px; padding-right: 20px;">
    <div class="row">
        <div class="col-lg-4 mb-3">
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
        <div class="col-lg-4 mb-3">
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
        <div class="col-lg-4 mb-3">
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
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3" style="background-color: #75606069;">
                <div class="card-body">
                    <canvas style="width: 300px; height: 250px; margin-left: -15px;" id="prestamoChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3" style="background-color: #75606069;">
                <div class="card-body">
                    <canvas style="width: 300px; height: 250px; margin-left: -15px;" id="estadoPrestamosChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3" style="background-color: #75606069;">
                <div class="card-body">
                    <canvas style="width: 300px; height: 250px; margin-left: -15px;" id="pagosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3" style="background-color: #75606069;">
                <div class="card-body">
                    <canvas style="width: 300px; height: 250px; margin-left: -15px;" id="zonasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3" style="background-color: #75606069;">
                <div class="card-body">
                    <canvas style="width: 300px; height: 250px; margin-left: -15px;" id="modosPagoChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3" style="background-color: #75606069;">
                <div class="card-body">
                    <canvas style="width: 300px; height: 250px; margin-left: -50px;" id="estadosClientesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Agrega tus scripts JavaScript aquí si es necesario -->
</body>



@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>
        .custom-container {
            max-width: 1600px;
            margin: 0 auto; /* Para centrar horizontalmente */
            margin-top: 50px; /* Ajusta el valor según tu diseño */
        }
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1em; /* Agrega un poco de espacio entre el título y el logo */
        }

        .logo {
            max-width: 100px; /* Ajusta el tamaño máximo del logo según tus necesidades */
            margin-right: 0.5em; /* Añade un pequeño espacio entre el logo y el título */
        }

        h1 {
            text-align: center;
            font-weight: bold;
            color: black;
            font-size: 4em;
            margin-bottom: 0;
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
                            backgroundColor: 'rgba(0, 102, 255, 0.5)',
                            borderColor: 'rgba(0, 102, 255, 1)',
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
                            backgroundColor: 'rgba(0, 102, 255, 0.5)',
                            borderColor: 'rgba(0, 102, 255, 1)',
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
                        }
                    }
                });
            });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        async function cargarZonas() {
        const response = await fetch('/dashboard/zonas');
        const data = await response.json();

        const nombresZonas = data.map(zona => zona.nombre_zona);
        const ctx = document.getElementById('zonasChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: nombresZonas,
                datasets: [{
                    data: Array.from({ length: nombresZonas.length }, () => 1), // Crea un array de 1s del mismo tamaño que nombresZonas
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        // Agrega más colores si tienes más zonas
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        // Agrega más colores si tienes más zonas
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

        cargarZonas(); // Llama a la función para cargar los datos y graficar
    </script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
       async function cargarRegistrosPorModoPago() {
           const response = await fetch('/dashboard/modos-pago');
           const data = await response.json();

           const modalidadesPago = data.map(registro => registro.modalidad_pago);
           const cantidadesRegistros = data.map(registro => registro.cantidad_registros);

           const ctx = document.getElementById('modosPagoChart').getContext('2d');
           new Chart(ctx, {
               type: 'bar',
               data: {
                   labels: modalidadesPago,
                   datasets: [{
                       label: 'Cantidad de Registros',
                       data: cantidadesRegistros,
                       backgroundColor: 'rgba(0, 102, 255, 0.5)',
                       borderColor: 'rgba(0, 102, 255, 1)',
                       borderWidth: 1
                   }]
               },
               options: {
                   responsive: true,
                   maintainAspectRatio: false,
                   scales: {
                       x: {
                           type: 'category', // Cambia el tipo a 'category' para manejar etiquetas personalizadas
                           title: {
                               display: true,
                               text: 'Modalidades de Pago'
                           }
                       },
                       y: {
                           beginAtZero: true,
                           title: {
                               display: true,
                               text: 'Cantidad'
                           }
                       }
                   }
               }
           });
       }

       cargarRegistrosPorModoPago();
   </script>
    <script>
        async function cargarEstadoPrestamos() {
            const response = await fetch('/dashboard/estados-prestamos');
            const data = await response.json();

            const labels = data.map(item => item.estado === 1 ? 'Deuda Cancelada' : 'Deuda Pendiente');
            const cantidades = data.map(item => item.cantidad);

            const ctx = document.getElementById('estadoPrestamosChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: cantidades,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 99, 132, 0.7)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        window.addEventListener('load', cargarEstadoPrestamos);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        async function cargarEstadosClientes() {
            const response = await fetch('/dashboard/estados-clientes');
            const data = await response.json();

            const estados = data.map(cliente => cliente.estado);
            const cantidades = data.map(cliente => cliente.cantidad);

            const ctx = document.getElementById('estadosClientesChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: estados,
                    datasets: [{
                        data: cantidades,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            // Agrega más colores si tienes más estados
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            // Agrega más colores si tienes más estados
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        window.addEventListener('load', cargarEstadosClientes);
    </script>
@stop







