@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">MODALIDAD DE PAGO</h1>
</center>
<p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

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
                <div class="card" style="background-color: #75606069">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <table class="table" style="background-color: white" id="example">
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
                        </table><p></p>
                        <a href="{{ route('modosPago.create') }}" class="btn btn-success fa fa-plus-square "> Agregar Modo de Pago</a>
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        //BOTON DE AYUDA
    document.getElementById('btnAyuda').addEventListener('click', function() {
        Swal.fire({
            title: 'Ayuda',
            html: '<embed src="/pdf/gananciadia.pdf" type="application/pdf" width="100%" height="800px" />',
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

        //BOTON DE LIMPIAR
    document.getElementById('btnLimpiar').addEventListener('click', function() {
        document.getElementById('efectivo').value = '';
    });

    </script>
    @stop
