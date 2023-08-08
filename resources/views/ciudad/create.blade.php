@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">CIUDADES</h1>
<p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
    <form action="{{ route('ciudades.store') }}" method="POST" id="guardar">
        @csrf

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

            <div class="card" style="background-color: #75606069">
                <div class="form-group">
                    <label for="cod_ciudad">
                        <i class="fas fa-city"></i> Código de ciudad
                    </label>
                    <input type="text" class="form-control" id="cod_ciudad" name="cod_ciudad">
                </div>

                <div class="form-group">
                    <label for="nombre_ciudad">
                        <i class="fas fa-map-marker-alt"></i> Nombre de ciudad
                    </label>
                    <input type="text" class="form-control" id="nombre_ciudad" name="nombre_ciudad">
                </div>

                <div class="form-group">
                    <label for="zona_id">
                        <i class="fas fa-globe"></i> Zona
                    </label>
                    <select class="form-control" id="zona_id" name="zona_id">
                        @foreach ($zonas as $zona)
                            <option value="{{ $zona->id }}">{{ $zona->nombre_zona }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar
            </button>


        </form>

            <br>
            <p><p></p></p>
        <table class="table" id="example">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Código de ciudad</th>
                    <th>Nombre de ciudad</th>
                    <th>Zona</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ciudades as $ciudad)
                    <tr>
                        <td>{{ $ciudad->id }}</td>
                        <td>{{ $ciudad->cod_ciudad }}</td>
                        <td>{{ $ciudad->nombre_ciudad }}</td>
                        <td>{{ $ciudad->zona->nombre_zona }}</td>

                            <td>
                                <a href="{{ route('ciudades.edit', $ciudad->id) }}" class="btn btn-warning fa fa-edit"> Editar</a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

        document.getElementById('btnLimpiar').addEventListener('click', function() {
            document.getElementById('cod_ciudad').value = '';
            document.getElementById('nombre_ciudad').value = '';
            document.getElementById('zona_id').selectedIndex = 0;
        });


    </script>

@stop
