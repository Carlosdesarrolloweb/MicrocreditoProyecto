
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <div class="logo-container">
        <img class="logo" src="{{ asset('pagos.png') }}" alt="Logo Microcréditos Mary">
        <h1 class="title">EDITAR PAGO</h1>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
    </div>
</center>

@stop

@section('content')
    <div class="container">
        <div class="card" style="background-color: #75606069">
            @if ($pago)
            <form action="{{ route('pagos.update', $pago->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="input-label">
                        <i class="fas fa-dollar-sign"></i>
                        <label for="monto_pago"> Monto de pago</label>
                    </div>
                    <input type="number" name="monto_pago" id="monto_pago" class="form-control" value="{{ $pago->monto_pago }}">
                </div>
                <div class="form-group">
                    <div class="input-label">
                        <i class="fas fa-file-alt"></i>
                        <label for="descripcion"> Descripción</label>
                    </div>
                    <textarea name="descripcion" id="descripcion" class="form-control">{{ $pago->descripcion }}</textarea>
                </div>
                <center>
                    <button type="submit" class="btn btn-success fas fa-save"> Actualizar</button>
                </center>
            </form>
        </div>
    </div>
    @endif




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
         .logo-container {
            text-align: center;
        }

        .logo {
            width: 100px;
            height: auto;
        }
    </style>

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop
