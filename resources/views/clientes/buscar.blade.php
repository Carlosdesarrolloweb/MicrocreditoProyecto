@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">CLIENTE</h1>
<p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
@stop



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Buscar cliente</div>
                <div class="card-body">
                    <form action="{{ route('buscar.cliente') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="carnet" class="col-md-4 col-form-label text-md-right">Carnet</label>

                            <div class="col-md-6">
                                <input id="carnet" type="text" class="form-control @error('carnet') is-invalid @enderror" name="carnet" value="{{ old('carnet') }}" autocomplete="carnet" autofocus>

                                @error('carnet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @isset($cliente->nombre)
                <div class="card mt-4">
                    <div class="card-header">Datos del cliente</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Carnet</th>
                                <td>{{ $cliente->Carnet_cliente }}</td>
                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $cliente->nombre_cliente }}</td>
                            </tr>
                            <tr>
                                <th>Apellido</th>
                                <td>{{ $cliente->apellido_cliente }}</td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td>{{ $cliente->direccion_cliente }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $cliente->email_cliente }}</td>
                            </tr>
                            <tr>
                                <th>Teléfono</th>
                                <td>{{ $cliente->telefono_cliente }}</td>
                            </tr>
                            <tr>
                                <th>Edad</th>
                                <td>{{ $cliente->edad_cliente }}</td>
                            </tr>
                            <tr>
                            <th>Teléfono de referencia</th>
                            <td>{{ $cliente->telefono_referencia }}</td>
                            </tr>
                            <tr>
                            <th>Estado</th>
                            <td>{{ $cliente->estado_cliente }}</td>
                            </tr>
                            <tr>
                            <th>Monto del préstamo</th>
                            <td>{{ $cliente->prestamos->monto_prestamo }}</td>
                            </tr>
                            <tr>
                            <th>Duración del préstamo</th>
                            <td>{{ $cliente->prestamos->duracion_prestamo }}</td>
                            </tr>
                            <tr>
                            <th>Cálculo de la cuota</th>
                            <td>{{ $cliente->prestamos->calculo_cuota }}</td>
                            </tr>
                            <tr>
                            <th>Ganancia</th>
                            <td>{{ $cliente->prestamos->ganancia }}</td>
                            </tr>
                            <tr>
                            <th>Cantidad de cuotas</th>
                            <td>{{ $cliente->prestamos->cantidad_cuotas }}</td>
                            </tr>
                            <tr>
                            <th>Monto cancelado</th>
                            <td>{{ $cliente->prestamos->monto_cancelado }}</td>
                            </tr>
                            <tr>
                            <th>Monto prestado</th>
                            <td>{{ $cliente->prestamos->monto_prestado }}</td>
                            </tr>
                            <tr>
                            <th>Interés</th>
                            <td>{{ $cliente->prestamos->interes->nombre }}</td>
                            </tr>
                            <tr>
                            <th>Método de pago</th>
                            <td>{{ $cliente->prestamos->modoPago->nombre }}</td>
                            </tr>
                            <tr>
                            <th>Fecha del préstamo</th>
                            <td>{{ $cliente->prestamos->fecha_prestamo }}</td>
                            </tr>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
@stop
