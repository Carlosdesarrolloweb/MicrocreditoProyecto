

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">REGISTRAR NUEVO INTERES %</h1>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
</center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Préstamo</th>
                        <th>Garantía</th>
                        <th>Valor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($garantias as $garantia)
                        <tr>
                            <td>{{ $garantia->cliente->nombre }}</td>
                            <td>{{ $garantia->prestamo->id }}</td>
                            <td>{{ $garantia->garantia }}</td>
                            <td>{{ $garantia->Valor_Prenda }}</td>
                            <td>
                                <a href="{{ route('garantias.show', $garantia->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('garantias.edit', $garantia->id) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('garantias.destroy', $garantia->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
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
