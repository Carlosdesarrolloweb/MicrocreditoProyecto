
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <center>
        <h1 style="text-align: center;font-weight: bold; color: black;">REGISTRAR MODO DE PAGO</h1>
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card bg-light border p-4 rounded" >
                        <div class="card-body" style="background-color: #75606069">
                            <form method="POST" id="guardar" action="{{ route('modos_pago.store') }}">
                                @csrf
                                <div class="form-group row" >
                                    <label for="modalidad_pago" class="col-md-4 col-form-label text-md-right"><i class="fas fa-credit-card"></i> Modalidad de Pago</label>

                                    <div class="col-md-6">
                                        <input id="modalidad_pago" type="text" class="form-control @error('modalidad_pago') is-invalid @enderror" name="modalidad_pago" value="{{ old('modalidad_pago') }}" required autocomplete="modalidad_pago" autofocus>

                                        @error('modalidad_pago')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus-circle"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </form>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop
