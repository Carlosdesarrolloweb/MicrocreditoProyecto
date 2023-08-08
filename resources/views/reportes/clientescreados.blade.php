@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <div class="logo-container">
        <img class="logo" src="{{ asset('repocliente.png') }}" alt="Logo Microcréditos Mary">
        <h1 class="title">CLIENTES CREADOS</h1>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
    </div>
</center>
@livewireStyles
<link rel="stylesheet" href="{{ asset('vendor/powergrid/powergrid.css') }}">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card" style="background-color: #75606069;">
            <div class="card-body">
                <livewire:clientes-table/>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .btn-secondary.dropdown-toggle {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
    display: flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    }
    .btn-secondary.dropdown-toggle .file-excel-icon {
        font-size: 5rem;
        margin-right: 5rem;
    }
    .btn-secondary.dropdown-toggle span {
        margin-right: 0.25rem;
    }
    .bg-blue-header {
    background-color: #3490dc;
    color: white;
    padding: 8px 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 4px;
    }
    .logo-container {
        text-align: center;
        }

    .logo {
        width: 100px;
        height: auto;
        }
</style>
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@livewireScripts
<script src="{{ asset('vendor/powergrid/powergrid.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.4.2/cdn.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>

</script>
@stop
