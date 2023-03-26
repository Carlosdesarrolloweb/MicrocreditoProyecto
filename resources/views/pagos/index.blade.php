@extends('adminlte::page')

@section('title', 'Registrar Pagos')

@section('content_header')
    <h1>Registrar Pagos</h1>
@stop

@section('content')
<div class="container">
    <h1 class="mb-3">Lista de Pagos</h1>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Fecha de Pago</th>
                        <th>Prestamo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                        <tr>
                            <td>{{ $pago->fecha_pago }}</td>
                            <td>{{ $pago->prestamo->cliente->nombre_cliente }} {{ $pago->prestamo->cliente->apellido_cliente }}</td>
                            <td>Bs.{{ $pago->monto_pago }}</td>
                            <td>Bs.{{ $pago->interes_pago }}</td>
                            <td>Bs.{{ $pago->capital_pago }}</td>
                            <td>Bs.{{ $pago->saldo_restante }}</td>
                            <td>{{ $pago->prestamo->fecha_prestamo }}</td>
                            <td>Bs.{{ $pago->prestamo->monto_prestamo }}</td>
                            <td>{{ $pago->prestamo->duracion_prestamo }}</td>
                            <td>{{ $pago->prestamo->cantidad_cuotas }}</td>
                            <td>Bs.{{ $pago->prestamo->calculo_cuota }}</td>
                            <td>
                                <a href="{{ route('pagos.show', $pago) }}" class="btn btn-primary btn-sm">Ver</a>
                                <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-secondary btn-sm">Editar</a>
                                <form method="POST" action="{{ route('pagos.destroy', $pago) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este pago?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $pagos->links() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>

    </script>
@stop
