@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">CLIENTES</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</th>
@livewireStyles
<link rel="stylesheet" href="{{ asset('vendor/powergrid/powergrid.css') }}">

@stop

@section('content')
<div class="container">
    <div class="style:bg-red">
        <livewire:clientes-table/>
      </div>
    </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    @livewireScripts
    <script src="{{ asset('vendor/powergrid/powergrid.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.4.2/cdn.min.js"></script>
         <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    @stop
