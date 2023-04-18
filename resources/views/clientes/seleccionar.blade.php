@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">CLIENTE</h1>
@stop

@section('content')

<h1>Resultados de la búsqueda</h1>

@if ($clientes->count() > 0)
    <div class="list-group">
        @foreach ($clientes as $cliente)
            <a href="{{ route('clientes.mostrar', ['cliente' => $cliente]) }}" class="list-group-item list-group-item-action">
                {{ $cliente->nombre_cliente }} - {{ $cliente->Carnet_cliente }}
            </a>
        @endforeach
    </div>
@else
    <p>No se encontró ningún cliente con ese criterio de búsqueda.</p>
@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
@stop
