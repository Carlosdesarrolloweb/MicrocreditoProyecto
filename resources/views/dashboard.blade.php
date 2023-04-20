@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black; font-size: 6em;">BIENVENID@</h1>
<center>
    <h1 style="text-align: center;font-weight: bold; color: red;"> {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</h1>
 </center>
@stop

@section('content')

        <body style="background-color: white;">
             <div class="row">
                <div class="col-lg-3 mb-3">
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
                <div class="col-lg-3 mb-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $cantidad_clientes_con_prestamo }}</h3>
                            <p>Clientes con préstamo</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $cantidad_garantias }}</h3>
                            <p>Garantías Registradas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </body>

@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>
        .container {
         margin-top: 80px;
        }
        .row {
        padding-left: 250px;
        }
        .col-lg-4 {
        padding-left: 15px;
        padding-right: 15px;
        }

    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src= "{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@stop







