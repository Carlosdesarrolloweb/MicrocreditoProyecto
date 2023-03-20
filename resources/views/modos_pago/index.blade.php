@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">MODALIDAD DE PAGO</h1>
</center>
@stop

@section('content')
    <div class="container">
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
