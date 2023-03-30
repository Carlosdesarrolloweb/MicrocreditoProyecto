<!-- Archivo: resources/views/loans/create.blade.php -->
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    {{-- <h1>REGISTRAR GARANTIA</h1> --}}
</center>
@stop
@section('content')

<div class="box">
    <div class="box-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Garantía</th>
                    <th>Valor Prenda</th>
                    <th>Detalle Prenda</th>
                    <th>Cliente</th>
                    <th>Prestamo</th>
                    <th>Fecha de Entrega</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($garantias as $garantia)
                    <tr>
                        <td>{{ $garantia->id }}</td>
                        <td>{{ $garantia->garantia }}</td>
                        <td>{{ $garantia->Valor_Prenda }}</td>
                        <td>{{ $garantia->Detalle_Prenda }}</td>
                        <td>{{ $garantia->cliente->nombre_cliente }} {{ $garantia->cliente->apellido_cliente }}</td>
                        <td>{{ $garantia->id_prestamo }}</td>
                        <td>{{ $garantia->fecha_entrega }}</td>
                        <td>{{ $garantia->estado }}</td>
                        <td><img src="{{ asset($garantia->imagen) }}" width="50"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    <script> console.log('Hi!'); </script> -->
    @stop
