@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;font-weight: bold; color: black;">AGREGAR NUEVA ZONA</h1>
     <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
@stop

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Crear Zona</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('zonas.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="cod_zona">Código de Zona</label>
                        <input type="text" class="form-control @error('cod_zona') is-invalid @enderror" id="cod_zona" name="cod_zona" value="{{ old('cod_zona') }}" required>
                        @error('cod_zona')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nombre_zona">Nombre de Zona</label>
                        <input type="text" class="form-control @error('nombre_zona') is-invalid @enderror" id="nombre_zona" name="nombre_zona" value="{{ old('nombre_zona') }}" required>
                        @error('nombre_zona')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success fa fa-save"> Crear</button>
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
