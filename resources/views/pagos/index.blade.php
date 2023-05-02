@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
    <center>
        <h1 style="text-align: center;font-weight: bold; color: black;">PAGOS REALIZADOS</h1>

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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-dark text-white">
                                <tr>
                                    <th>Cliente</th>
                                    <th>Prestamo</th>
                                    <th>Fecha de pago</th>
                                    <th>Monto de pago</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th> <!-- Agregamos una nueva columna para las acciones -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pagos as $pago)
                                    <tr>
                                        <td>{{ $pago->prestamo->cliente->nombre_cliente}} {{ $pago->prestamo->cliente->apellido_cliente }}</td>
                                        <td>{{ $pago->prestamo->monto_prestamo }}</td>
                                        <td>{{ $pago->fecha_pago }}</td>
                                        <td>{{ $pago->monto_pago }}</td>
                                        <td>{{ $pago->descripcion }}</td>
                                        <td>
                                            <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-primary btn-sm">Editar</a> <!-- Agregamos el botón Editar que redirige a la vista de edición -->
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
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('vendor/jquery-table2excel/dist/jquery.table2excel.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    </script>
@stop
