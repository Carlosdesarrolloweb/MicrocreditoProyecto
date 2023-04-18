
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">EDITAR GARANTIAS</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
</th>

@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('garantias.update', $garantia->id) }}" method="POST">
                 @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="garantia">Garantía</label>
                    <input type="text" name="garantia" id="garantia" class="form-control" value="{{ $garantia->garantia }}">
                </div>

                <div class="form-group">
                    <label for="valor_prenda">Valor Prenda</label>
                    <input type="text" name="Valor_prenda" id="Valor_Prenda" class="form-control" value="{{ $garantia->valor_prenda }}">
                </div>

                <div class="form-group">
                    <label for="detalle_prenda">Detalle Prenda</label>
                    <input type="text" name="Detalle_Prenda" id="Detalle_Prenda" class="form-control" value="{{ $garantia->detalle_prenda }}">
                </div>

                {{-- <div class="form-group">
                        <label for="cliente_id">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="form-control">
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $garantia->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                    <label for="id_prestamo">Préstamo</label>
                    <input type="text" name="id_prestamo" id="id_prestamo" class="form-control" value="{{ $garantia->id_prestamo }}">
                    </div> --}}

                <div class="form-group">
                    <label for="fecha_entrega">Fecha de Entrega</label>
                    <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" value="{{ $garantia->fecha_entrega }}">
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="ARTICULO NUEVO" {{ $garantia->estado == 'Activo' ? 'selected' : '' }}>ARTICULO NUEVO</option>
                        <option value="ARTICULO USADO" {{ $garantia->estado == 'Inactivo' ? 'selected' : '' }}>ARTICULO USADO</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>







@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop
