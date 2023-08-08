@extends('adminlte::page')

@section('title', 'Editar Modo de Pago')

@section('content_header')

<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">EDITAR MODO DE PAGO</h1>
</center>
<p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-light border p-4 rounded">
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                        <i class="fas fa-question-circle fa-lg"></i> Ayuda
                    </button>
                    <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                        <i class="fas fa-sign-out-alt fa-lg"></i> Salir
                    </button>
                </div>
                <div class="card-body" style="background-color: #75606069">
                    <form action="{{ route('modos_pago.update', $modoPago->id) }}" method="POST" id="guardar">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="modalidad_pago"><i class="fas fa-credit-card"></i> Modalidad de Pago</label>
                            <input type="text" class="form-control" name="modalidad_pago" value="{{ $modoPago->modalidad_pago }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .custom-box {
       background-color: #75606069;
       border: 1px solid #ccc;
       padding: 20px;
       border-radius: 5px;
       }
   .custom-modal {
       width: 90% !important;
       max-width: 1200px !important;
       }
</style>
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
    <script>
        //BOTON DE AYUDA
    document.getElementById('btnAyuda').addEventListener('click', function() {
        Swal.fire({
            title: 'Ayuda',
            html: '<embed src="/pdf/crearpago.pdf" type="application/pdf" width="100%" height="800px" />',
            confirmButtonText: 'Cerrar',
            customClass: {
            content: 'modal-lg',
            popup: 'custom-modal'
            }
        });
    });
        //BOTON DE SALIR
    document.getElementById('btnSalir').addEventListener('click', function() {
    window.location.href = "{{ route('dashboard') }}";
    });

      /*   //BOTON DE LIMPIAR
    document.getElementById("btnLimpiar").addEventListener("click", function() {
        document.getElementById("cod_zona").value = "";
        document.getElementById("nombre_zona").value = "";
        document.getElementById("mensaje-error").innerHTML = "";
    });
    */

    </script>
@stop

