@extends('adminlte::page')

@section('title', 'Editar Modo de Pago')

@section('content_header')

<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">EDITAR MODO DE PAGO</h1>
</center>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('modos_pago.update', $modoPago->id) }}" method="POST" id="guardar">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="modalidad_pago">Modalidad de Pago</label>
                    <input type="text" class="form-control" name="modalidad_pago" value="{{ $modoPago->modalidad_pago }}" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi!'); </script>

<Script>
    $(document).ready(function() {
        $('#guardar').submit(function(e) {


            // Si se llega a este punto, todos los campos están completos
            Swal.fire({
            icon: 'success',
            title: 'Guardado exitosamente',
            text: 'Tu registro ha sido guardado exitosamente.'
            });
        });
    });
</script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop

