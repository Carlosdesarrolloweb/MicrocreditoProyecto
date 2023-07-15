@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;font-weight: bold; color: black;">ZONAS CREADAS</h1>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Zonas</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($zonas as $zona)
                            <tr>
                                <td>{{ $zona->cod_zona }}</td>
                                <td>{{ $zona->nombre_zona }}</td>
                                <td>
                                    <a href="{{ route('zonas.edit', $zona->id) }}" class="btn btn-warning fa fa-edit"> Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script> console.log('Hi!'); </script> -->
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
