@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">GANANCIAS MENSUALES</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
</th>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

@stop

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>Ganancias Mensuales</h4>
                    <table id="gananciasMensuales" class="table table-striped table-bordered table-sm text-center">
                        <thead class="bg-dark">
                            <tr>
                                <th>Año</th>
                                <th>Mes</th>
                                <th>Ganancia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gananciasMensuales as $gananciaMensual)
                                <tr>
                                    <td>{{ $gananciaMensual['año'] }}</td>
                                    <td>{{ $gananciaMensual['mes'] }}</td>
                                    <td>{{ $gananciaMensual['ganancia'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Gráfico Line Chart -->
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-0"> <!-- Agregada la clase "my-2" -->
                <div class="card-body">
                    <h4>Gráfico de Ganancias Mensuales</h4>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#gananciasMensuales').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script para generar el gráfico -->
    <script>
        // Obtener los datos de ganancias mensuales desde el controlador
        var gananciasMensuales = {!! json_encode($gananciasMensuales) !!};

        // Obtener los meses y ganancias
        var meses = gananciasMensuales.map(function(ganancia) {
            return ganancia.mes;
        });

        var ganancias = gananciasMensuales.map(function(ganancia) {
            return ganancia.ganancia;
        });

        // Configurar el gráfico
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Ganancias Mensuales',
                    data: ganancias,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderWidth: 1,
                    pointRadius: 5,
                    pointBackgroundColor: 'blue',
                    pointBorderColor: 'white',
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: 'blue',
                    pointHoverBorderColor: 'white'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value.toFixed(2); // Formato de dos decimales
                            }
                        }
                    }
                }
            }
        });
    </script>
@stop
