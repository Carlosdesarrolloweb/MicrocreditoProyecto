

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">REGISTRAR NUEVO INTERES %</h1>
</center>
<p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
@stop

@section('content')
    <div class="container">
        <div class="card-footer text-right">
            <button type="button" class="btn btn-danger btn-lg" id="btnLimpiar">
                 <i class="far fa-file-alt fa-lg"></i> Limpiar
            </button>
            <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                 <i class="fas fa-question-circle fa-lg"></i> Ayuda
            </button>
            <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                 <i class="fas fa-sign-out-alt fa-lg"></i> Salir
            </button>
         </div>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-box" style="background-color: #75606069; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
                    <div class="card-header">Agregar Interés</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('interests.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="interes_prestamo" class="col-md-4 col-form-label text-md-right">Interés del préstamo %</label>

                                <div class="col-md-6">
                                    <input id="interes_prestamo" type="number" class="form-control @error('interes_prestamo') is-invalid @enderror" name="interes_prestamo" value="{{ old('interes_prestamo') }}" required autocomplete="interes_prestamo" autofocus>

                                    @error('interes_prestamo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </form>
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
<script> console.log('Hi!'); </script> -->
@stop
