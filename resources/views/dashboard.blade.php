@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black; font-size: 6em;">BIENVENID@</h1>

@stop

@section('content')

        <body style="background-color: white;">
            <center>


                <h1 style="text-align: center;font-weight: bold; color: red;"> {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</h1>
                <p>
                    <p>
                        <p>

                        </p>
                    </p>
                </p>
                <img src="{{URL::asset('https://files.fm/thumb_show.php?i=rh59me2xy')}}">
             </center>

        </body>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src= "{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


@stop







