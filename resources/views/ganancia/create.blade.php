
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <div class="logo-container">
        <img class="logo" src="{{ asset('ganancia.png') }}" alt="Logo Microcréditos Mary">
        <h1 class="title">GANANCIAS</h1>
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
                    <button type="button" class="btn btn-danger btn-lg" id="btnLimpiar">
                        <i class="far fa-file-alt fa-lg"></i> Limpiar
                    </button>
                    <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                        <i class="fas fa-question-circle fa-lg"></i> Ayuda
                    </button>
                    <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                        <i class="fas fa-sign-out-alt fa-lg"></i> Salir
                    </button>
                </div>
            </div>
            <div class="card" style="background-color: #75606069">
                <div class="card-body" >
                    <form action="{{ route('ganancia.actualizar') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="efectivo">
                                <i class="fas fa-money-bill"></i> Efectivo actual:
                            </label>
                            <input type="number" step="0.01" name="efectivo" id="efectivo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha">
                                <i class="far fa-calendar-alt"></i> Fecha:
                            </label>
                            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        @method('POST')
                        <button type="submit" class="btn btn-success"> <i class="fas fa-check-circle"></i> Actualizar Efectivo</button>
                    </form>
                    <br>
                    <table id="example" class="table table-striped table-bordered table-sm text-center" style="background-color: white">
                        <thead class="bg-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Dinero Prestado</th>
                                <th>Monto Cobrado</th>
                                <th>Prestamo</th>
                                <th>Dinero Efectivo</th>
                                <th>Total</th>
                                <th>Ganancia</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $gananciaTotalAnterior = null;
                                $totalMontoPrestado = 0;
                                $montoCancelado = 0;
                                $gananciaTotalayer=0;
                                $dineroPrestadoAnterior = 0;
                                $sumaAcumuladaPrestamos = 0; // Variable para llevar el registro de la suma acumulada
                            @endphp

                            @foreach ($ganancias as $key => $ganancia)
                                @php
                                    $total = $ganancia->monto + $ganancia->efectivo;
                                    $gananciaHoy = $total - $gananciaTotalAnterior;
                                    $gananciaTotalAnterior = $total;

                                    $gananciaAyer = isset($ganancias[$key - 1]) ? $ganancias[$key - 1]->monto + $ganancias[$key - 1]->efectivo : 0;
                                    $gananciaCalculada = $total - $gananciaAyer;

                                    // Consultas para obtener los montos prestados y cancelados
                                    // Reemplazamos "fecha" por "fecha_prestamo"
                                    $montoPrestado = App\Models\Prestamo::where('fecha_prestamo', $ganancia->fecha)->sum('monto_prestado');
                                    $montoCancelado = App\Models\Prestamo::where('fecha_prestamo', $ganancia->fecha)->sum('monto_cancelado');
                                    $totalMontoPrestado = $montoPrestado - $montoCancelado;

                                    // Actualizamos la suma acumulada de los montos prestados
                                    $sumaAcumuladaPrestamos += $totalMontoPrestado;

                                    if ($key==0) {
                                        $gananciaT=0;
                                        $gananciaTotalayer = $sumaAcumuladaPrestamos + $ganancia->efectivo;

                                    }
                                    else {
                                        $gananciaT=  ($sumaAcumuladaPrestamos + $ganancia->efectivo)-$gananciaTotalayer ;
                                        $gananciaTotalayer = $sumaAcumuladaPrestamos +$ganancia->efectivo;
                                    }
                                        // Actualiza el modelo GananciaDia con la ganancia calculada
                                        $gananciaDia = App\Models\GananciaDia::find($ganancia->id);
                                        $gananciaDia->ganancia = $gananciaT;
                                        $gananciaDia->save();
                                @endphp
                                <tr>
                                    <td>{{ $ganancia->fecha }}</td>
                                    <td>
                                        {{ $sumaAcumuladaPrestamos }}
                                        @if ($ganancia->fecha == date('Y-m-d'))
                                            (Deuda General: {{ $sumaAcumuladaPrestamos - $montoCancelado }})
                                        @endif
                                    </td>
                                    <td>{{ $ganancia->monto }}</td>
                                    <td>{{ $montoPrestado }}</td>
                                    <td>{{ $ganancia->efectivo }}</td>
                                    <td>{{ $sumaAcumuladaPrestamos + $ganancia->efectivo }}</td>
                                    <td>
                                        @if ($gananciaT > 0)
                                            <span class="badge badge-success">{{ $gananciaT }}</span>
                                        @elseif ($gananciaT < 0)
                                            <span class="badge badge-danger">{{ $gananciaT }}</span>
                                        @else
                                            {{ $gananciaT }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
        $('#example').DataTable({
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
    <script>
        //BOTON DE AYUDA
    document.getElementById('btnAyuda').addEventListener('click', function() {
        Swal.fire({
            title: 'Ayuda',
            html: '<embed src="/pdf/gananciadia.pdf" type="application/pdf" width="100%" height="800px" />',
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

        //BOTON DE LIMPIAR
    document.getElementById('btnLimpiar').addEventListener('click', function() {
        document.getElementById('efectivo').value = '';
    });

    </script>
@stop
