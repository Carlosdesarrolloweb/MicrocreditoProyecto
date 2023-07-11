
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">GANANCIAS</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
</th>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

@stop

@section('content')
<div class="container-fluid">
    <x-slot name="header"></x-slot>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ganancia.actualizar') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="efectivo">Efectivo actual:</label>
                            <input type="number" step="0.01" name="efectivo" id="efectivo" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Efectivo</button>
                    </form>
                    <br>
                    <table id="example" class="table table-striped table-bordered table-sm text-center">
                        <thead class="bg-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Monto Cobrado</th>
                                <th>Monto en Caja</th>
                                <th>Monto Prestado</th>
                                <th>Total</th>
                                <th>Ganancia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $gananciaTotalAnterior = 0;
                            $sumaMontoPrestado = 0; // Declarar la variable antes de utilizarla
                            $sumaMontoCancelado = 0; // Declarar la variable antes de utilizarla
                        @endphp

                        @foreach ($ganancias as $ganancia)
                            @php
                                $total = $ganancia->monto + $ganancia->efectivo;
                                $gananciaHoy = $total - $gananciaTotalAnterior;
                                $gananciaTotalAnterior = $total;
                                $montoPrestado = $ganancia->prestamo ? $ganancia->prestamo->monto_prestado - $ganancia->prestamo->monto_cancelado : 0;
                                $sumaMontoPrestado += $montoPrestado; // Sumar el monto prestado en cada iteración
                                $sumaMontoCancelado += $ganancia->prestamo ? $ganancia->prestamo->monto_cancelado : 0; // Sumar el monto cancelado en cada iteración
                                $totalMontoPrestado = $sumaMontoPrestado - $sumaMontoCancelado;
                            @endphp
                            <tr>
                                <td>{{ $ganancia->fecha }}</td>
                                <td>{{ $ganancia->monto }}</td>
                                <td>{{ $ganancia->efectivo }}</td>
                                <td>{{ $montoPrestado }}</td>
                                <td>{{ $total }}</td>
                                <td>{{ $ganancia->fecha == date('Y-m-d') ? $gananciaHoy : '' }}</td>
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
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
            $(document).ready(function() {
            $('#efectivoForm').submit(function(e) {
                e.preventDefault(); // previene el envío del formulario

                var efectivo = parseFloat($('#efectivo').val());

                // Aquí puedes hacer una llamada AJAX para enviar el valor de efectivo al servidor
                // y realizar las operaciones necesarias, como actualizar la base de datos o realizar cálculos adicionales.

                // Ejemplo de llamada AJAX
                $.ajax({
                    url: '/actualizar-efectivo', // Ruta del controlador que manejará la actualización del efectivo
                    method: 'POST',
                    data: {
                        efectivo: efectivo
                    },
                    success: function(response) {
                        // Manejar la respuesta del servidor si es necesario
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

@stop
