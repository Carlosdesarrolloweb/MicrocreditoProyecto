@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black; font-size: 6em;">BIENVENID@</h1>

@stop

@section('content')

        <body style="background-color: white;">
            <center>


                <h1 style="text-align: center;font-weight: bold; color: red;"> {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</h1>

             </center>


             <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $cantidad_clientes }}</h3>
                            <p>Clientes creados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
{{--             <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            @if($prestamos != null)
                                <!-- Mostrar los préstamos -->
                            @else
                                <p>No hay préstamos disponibles</p>
                            @endif
                            <p>Préstamos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div> --}}

        </body>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src= "{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


@stop







