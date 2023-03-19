@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;">CIUDADES</h1>
@stop

@section('content')




    <form action="{{ route('ciudades.store') }}" method="POST">
        @csrf

        <div class="container">
            <h1>Ciudades</h1>
        <div class="form-group">
            <label for="cod_ciudad">Código de ciudad</label>
            <input type="text" class="form-control" id="cod_ciudad" name="cod_ciudad">
        </div>

        <div class="form-group">
            <label for="nombre_ciudad">Nombre de ciudad</label>
            <input type="text" class="form-control" id="nombre_ciudad" name="nombre_ciudad">
        </div>

        <div class="form-group">
            <label for="zona_id">Zona</label>
            <select class="form-control" id="zona_id" name="zona_id">
                @foreach ($zonas as $zona)
                    <option value="{{ $zona->id }}">{{ $zona->nombre_zona }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código de ciudad</th>
                <th>Nombre de ciudad</th>
                <th>Zona</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ciudades as $ciudad)
                <tr>
                    <td>{{ $ciudad->id }}</td>
                    <td>{{ $ciudad->cod_ciudad }}</td>
                    <td>{{ $ciudad->nombre_ciudad }}</td>
                    <td>{{ $ciudad->zona->nombre_zona }}</td>

                        <td>
                            <a href="{{ route('ciudades.edit', $ciudad->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                </tr>
            @endforeach
        </tbody>
        </table>

    </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
@stop
