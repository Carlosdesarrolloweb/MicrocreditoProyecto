
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">EDITAR GARANTIAS</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
</th>

@stop

@section('content')
    <div class="container">
        <h1>Editar pago</h1>
        @if ($pago)
        <form action="{{ route('pagos.update', $pago->id) }}" method="POST">
            @csrf
            @method('PUT')
{{--             <div class="form-group">
                <label for="id_prestamo">Préstamo</label>
                <select name="id_prestamo" id="id_prestamo" class="form-control" disabled>
                    <option value="{{ $pago->prestamo->id }}">{{ $pago->prestamo->id }}</option>
                </select>
            </div> --}}
{{--             <div class="form-group">
                <label for="fecha_pago">Fecha de pago</label>
                <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" value="{{ $pago->fecha_pago }}">
            </div> --}}
        {{--     <div class="form-group">
                <label for="Numero_Cuota">Número de cuota</label>
                <input type="number" name="Numero_Cuota" id="Numero_Cuota" class="form-control" value="{{ $pago->Numero_Cuota }}">
            </div> --}}
            <div class="form-group">
                <label for="monto_pago">Monto de pago</label>
                <input type="number" name="monto_pago" id="monto_pago" class="form-control" value="{{ $pago->monto_pago }}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ $pago->descripcion }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
    @endif




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop
