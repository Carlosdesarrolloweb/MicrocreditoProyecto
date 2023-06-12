@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">REGISTRAR PAGO</h1>
</center>
@stop



@section('content')
    <div class="container">
        <h1>Calendario de Pagos</h1>

        <form action="{{ route('calendarioPagos') }}" method="GET">
            <div class="form-group">
                <label for="cliente">Seleccionar cliente:</label>
                <select name="cliente" id="cliente" class="form-control">
                    <!-- Iterar sobre los clientes disponibles -->
                    @foreach ($prestamos as $prestamo)
                        <option value="{{ $prestamo->id_cliente }}">{{ $prestamo->cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mostrar Calendario</button>
        </form>

        <!-- Aquí se mostrará el calendario de pagos -->
    </div>
@endsection




@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi!'); </script> -->
