@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <div class="logo-container">
        <img class="logo" src="{{ asset('gananciam.png') }}" alt="Logo Microcréditos Mary">
        <h1 class="title">GANANCIAS MENSUALES</h1>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
    </div>
</center>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

@stop

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group col-md-12">
                <div class="col-md-12 text-right mb-3">
                    <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                        <i class="fas fa-question-circle fa-lg"></i> Ayuda
                    </button>
                    <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                        <i class="fas fa-sign-out-alt fa-lg"></i> Salir
                    </button>
                </div>
            </div>
            <div class="card" style="background-color: #75606069;" >
                <div class="card-body">
                    <h4>Ganancias Mensuales</h4>
                    <table id="gananciasMensuales" class="table table-striped table-bordered table-sm text-center" >
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
<div class="container-fluid mt-4" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-2" style="background-color: #75606069;"> <!-- Agregada la clase "my-2" -->
                    <canvas style="width: auto; height: 500px;" id="lineChart"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .custom-box {
           background-color: #75606069;
           border: 1px solid #ccc;
           padding: 20px;
           border-radius: 5px;
           }
       .custom-modal {
           width: 90% !important;
           max-width: 1200px !important;
           }
        .logo-container {
            text-align: center;
        }

        .logo {
            width: 100px;
            height: auto;
        }
   </style>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
        $('#gananciasMensuales').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrados de _MAX_ registros totales)",
                "search" : 'Buscar',
                "paginate" : {
                    'next' : 'Siguiente',
                    'previous':'Anterior'

                }
            }
        });
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
                maintainAspectRatio: false, // Desactivar el ajuste automático del tamaño
                responsive: false, // Desactivar la respuesta a cambios de tamaño
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
    <script>
        //BOTON DE AYUDA
    document.getElementById('btnAyuda').addEventListener('click', function() {
        Swal.fire({
            title: 'Ayuda',
            html: '<embed src="/pdf/gananciamensual.pdf" type="application/pdf" width="100%" height="800px" />',
            confirmButtonText: 'Cerrar',
            customClass: {
            content: 'modal-lg',
            popup: 'custom-modal'
            }
        });
    });
        //BOTON DE SALIR
    document.getElementById('btnSalir').addEventListener('click', function() {
    window.location.href = "{{ route('dashboard') }}";
    });

      /*   //BOTON DE LIMPIAR
    document.getElementById("btnLimpiar").addEventListener("click", function() {
        document.getElementById("cod_zona").value = "";
        document.getElementById("nombre_zona").value = "";
        document.getElementById("mensaje-error").innerHTML = "";
    });
    */

    </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop
