@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">MODALIDAD DE PAGO</h1>
</center>
<p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>

@stop

@section('content')
    <div class="container">
        <div class="card-footer text-right">
            {{--  <button type="button" class="btn btn-danger btn-lg" id="btnLimpiar">
                 <i class="far fa-file-alt fa-lg"></i> Limpiar
             </button> --}}
             <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                 <i class="fas fa-question-circle fa-lg"></i> Ayuda
             </button>
             <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                 <i class="fas fa-sign-out-alt fa-lg"></i> Salir
             </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="bg-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Modalidad de Pago</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modosPago as $modoPago)
                                    <tr>
                                        <td>{{ $modoPago->id }}</td>
                                        <td>{{ $modoPago->modalidad_pago }}</td>
                                        <td>
                                            <a href="{{ route('modosPago.edit', $modoPago->id) }}" class="btn btn-warning fa fa-edit">Editar</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('modosPago.create') }}" class="btn btn-success fa fa-plus-square ">Agregar Modo de Pago</a>
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
    <script> console.log('Hi!'); </script>
    @stop
