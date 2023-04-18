@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;"> CLIENTE</h1>
@stop

@section('content')

<h1>Datos del cliente</h1>




@foreach($clientes as $cliente)
    <a href="{{ route('clientes.mostrar', ['criterio' => $cliente->nombre_cliente]) }}">{{ $cliente->nombre_cliente }}</a>
@endforeach


@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
@stop
