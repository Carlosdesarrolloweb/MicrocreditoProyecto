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
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table">
                        <a href="#" class="btn btn-primary" id="download-btn">Descargar en Excel</a>
                        <thead class="table-dark" style="text-align: center">
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
@stop








@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('vendor/jquery-table2excel/dist/jquery.table2excel.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
@stop
