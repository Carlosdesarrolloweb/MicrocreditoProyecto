@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">CLIENTE</h1>
@stop

@section('content')

{{-- <form action="{{ route('clientes.mostrar', ['criterio' => $criterio]) }}" method="get"> --}}
    <form action="{{ route('clientes.buscar') }}" method="get">
        <div class="form-group">
            <label for="criterio">Buscar cliente:</label>
            <input type="text" name="criterio" id="criterio" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
@stop
