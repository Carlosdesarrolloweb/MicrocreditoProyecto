@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">NUEVO PRESTAMO</h1>

    <th>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ date('d/m/Y') }}</P>
    </th>

</center>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<div class="container-fluid">
    <x-slot name="header">
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead class="bg-dark text-white">
                                <tr>

                                    <th>Cliente</th>
                                    <th>Interés</th>
                                    {{-- <th>Modo de Pago</th> --}}
                                    <th>Monto del Préstamo</th>
                                    <th>Duración del Préstamo (en meses)</th>
                                    <th>Cantidad de Cuotas</th>
                                    <th>Cálculo de Cuota</th>
                                    <th>Ganancia</th>
                                    <th>Monto Prestado</th>
                                    <th>Monto Cancelado</th>
                                    <th>Fecha Prestamo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prestamos as $prestamo)
                                <tr>
                                    <td>{{ $prestamo->cliente->nombre_cliente }} {{ $prestamo->cliente->apellido_cliente }}</td>
                                    <td>{{ $prestamo->interes->interes_prestamo }}%</td>
                                    {{-- <td>{{ $prestamo->modo_pago->modalidad_pago }}</td> --}}
                                    <td>Bs.{{ $prestamo->monto_prestamo }}</td>
                                    <td>{{ $prestamo->duracion_prestamo }}</td>
                                    <td>{{ $prestamo->cantidad_cuotas }}</td>
                                    <td>Bs.{{ $prestamo->calculo_cuota }}</td>
                                    <td>Bs.{{ $prestamo->ganancia }}</td>
                                    <td>Bs.{{ $prestamo->monto_prestado }}</td>
                                    <td>Bs.{{ $prestamo->monto_cancelado }}</td>
                                    <td>{{ $prestamo->fecha_prestamo }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    <script src="{{ asset('vendor/jquery-table2excel/dist/jquery.table2excel.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $('th a').click(function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        window.location.href = url;
    });

    $(document).ready(function() {
        $("#download-btn").click(function(e) {
            e.preventDefault();
            var table = $("#prestamos").table2excel({
                filename: "prestamos.xls"
            });
            window.location.href = table;
        });
    });
</script>
<Script>
    $(document).ready(function () {
    $('#example').DataTable();
    });
</Script>
@stop
