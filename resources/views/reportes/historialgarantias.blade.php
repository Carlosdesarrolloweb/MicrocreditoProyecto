@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">HISTORIAL DE GARANTIAS DE CLIENTES</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</th>
@livewireStyles
<link rel="stylesheet" href="{{ asset('vendor/powergrid/powergrid.css') }}">

@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <livewire:garantia-table/>
                </div>
            </div>
        </div>
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
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
            // Aquí configuro las opciones de PowerGrid
            const powerGridOptions = {
                // Ajustar el ancho de la tabla y las columnas
                tableWidth: '100%',
                columns: [
                    { field: 'campo1', header: 'Campo 1', width: '15%' },
                    { field: 'campo2', header: 'Campo 2', width: '20%' },
                    // Ajustar las otras columnas según los datos
                ],
            };

            // Inicializa PowerGrid
            const powerGrid = new PowerGrid('#tableContainer', powerGridOptions);

            // Llama a la función para cargar los datos del componente Livewire en PowerGrid
            Livewire.on('dataLoaded', (data) => {
                powerGrid.refresh(data);
            });
        </script>

    @stop
