

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">CLIENTES</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</th>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<div class="container-fluid">
    <x-slot name="header">
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group col-md-12">
                <div class="col-md-12 text-right mb-3">
                    <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                        <i class="fas fa-question-circle fa-lg"></i> Ayuda
                    </button>
                    <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                        <i class="fas fa-sign-out-alt fa-lg"></i> Salir
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered table-sm text-center" style="width:100%">
                            <thead class="bg-dark text-white">
                                <tr scope="col">
                                    <th scope="col">Carnet</th>
                                    <th scope="col">Nombres </th>
                                    <th scope="col">Telefono </th>
                                    <th scope="col">Dirección </th>
                                    <th scope="col">Zona</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Imágenes</th>
                                    <th scope="col">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Clientes as $clientesv)
                                <tr>
                                    <td scope="col">{{$clientesv->Carnet_cliente}}</td>
                                    <td scope="col">{{$clientesv->nombre_cliente}} {{$clientesv->apellido_cliente}}</td>
                                    <td scope="col">{{$clientesv->telefono_cliente}}</td>
                                    <td scope="col">{{$clientesv->direccion_cliente}}</td>
                                    <td scope="col">{{$clientesv->zona->nombre_zona}}</td>
                                    <td scope="col">
                                        <span class="badge
                                          @if($clientesv->estado_cliente == 'CLIENTE NUEVO') badge-warning
                                          @elseif($clientesv->estado_cliente == 'MAL CLIENTE') badge-danger
                                          @elseif($clientesv->estado_cliente == 'BUEN CLIENTE') badge-success
                                          @endif
                                          text-dark">
                                          {{ $clientesv->estado_cliente }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-img="{{$clientesv->foto->direccion_imagen}}" data-title="FOTO CARNET ANVERSO">
                                            <i class="fas fa-image"></i>
                                        </button>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-img="{{$clientesv->fotocarnet->direccion_imagen}}" data-title="FOTO CARNET ATRAS">
                                            <i class="fas fa-image"></i>
                                        </button>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-img="{{$clientesv->fotorecibo->direccion_imagen}}" data-title="FOTO RECIBO AGUA/LUZ">
                                            <i class="fas fa-image"></i>
                                        </button>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-img="{{$clientesv->fotocroquis->direccion_imagen}}" data-title="FOTO CROQUIS DOMICILIO">
                                            <i class="fas fa-image"></i>
                                        </button>

                                    </td>
                                    <td>
                                        <a href="{{ route('clientes.editarclientes',$clientesv->id) }}" type="button" class="btn btn-warning"><i class='fas fa-user-edit'></i> </a>

                                        <form action="{{ route('clientes.eliminarclientes',$clientesv->id) }}" class="d-inline formulario-eliminar">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> </button>
                                        </form>
                                        <a href="{{ route('pdf.generate', ['cliente_id' => $clientesv->id]) }}" class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        <center>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Título del modal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <img id="mi_imagen" src=""> --}}
                                            <img id="imagenModal" src="" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .thumbnail {
            border: none;
            padding: 0px;
        }

        .modal-dialog {
            max-width: 800px !important;
            margin: 0;
        }

        .modal-content {
            width: 70%;
            height: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content img {
        max-width: 95%;
        max-height: 90%;
        width: auto;
        height: auto;
        }
        .modal-body img {
            max-width: 100%;
            max-height: 100%;
            width: 1000px;
            height: 800px;
        }


        .modal-close {
            position: absolute;
            right: 0;
            top: 0;
            z-index: 1;
            padding: 0.75rem;
            color: #fff;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 0px;
            transition: background 0.3s ease;
            font-size: 1.5rem;
            line-height: 1;
            text-shadow: none;
        }

        .modal-close:hover {
            background: rgba(0, 0, 0, 0.5);
            text-decoration: none;
        }

        .modal-close:focus {
            outline: none;
            box-shadow: none;
        }

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
<script src="{{ asset('vendor/powergrid/powergrid.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>



<script>
    // Agregar un evento de escucha para el envío del formulario
    $('#search-form').submit(function(event) {
        event.preventDefault(); // Prevenir la acción predeterminada del envío del formulario

        // Obtener el término de búsqueda del campo de entrada de texto
        var searchTerm = $('#search_term').val();

        // Enviar una solicitud Ajax al servidor
        $.ajax({
            url: "{{ route('clientes.buscarClientes') }}",
            method: "POST",
            data: { texto: searchTerm, _token: "{{ csrf_token() }}" },
            dataType: "html",
            success: function(searchResults) {
                // Procesar los datos de respuesta y mostrar los resultados en la página
                $('#search-results').html(searchResults);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>
<script>
    $(function() {
        $('.thumbnail').click(function() {
            $('#imagepreview').attr('src', $(this).attr('data-img'));
            $('#myModalLabel').text($(this).attr('data-title'));
            $('#imagemodal').modal('show');
        });
    });
</script>
    <script> console.log('Hi!'); </script>
    <script>
     function mostrarimagen(url,titulo) {
        $("#mi_imagen").attr("src",url);
        $('#exampleModalLabel').html(titulo);
        $('#exampleModal').modal('show');
    }
    </script>

    <script>
         $(document).ready(function() {
        // Agregar evento de clic al icono de la imagen
        $('button[data-target="#exampleModal"]').click(function() {
            // Obtener la dirección de la imagen y el título del botón
            var imgSrc = $(this).data('img');
            var title = $(this).data('title');
            // Establecer el contenido del modal con la imagen y el título
            $('#exampleModal').find('#imagenModal').attr('src', imgSrc);
            $('#exampleModal').find('.modal-title').text(title);
        });
    });
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado',
                'El Cliente se elimino con exito',
                'success'
                )
        </script>

    @endif
    @if(session('error'))
    <script>
        Swal.fire(
            'Error',
            '{{ session('error') }}',
            'error'
        )
    </script>
    @endif
        <script>
            $('.formulario-eliminar').submit(function(e){
                e.preventDefault();
                Swal.fire({
                title: 'Estas Seguro?',
                text: "Estos datos se eliminaran definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,Eliminar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {

                      this.submit();
                }
                })
            });

        </script>

     <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script>
    $(document).ready(function () {
    $('#example').DataTable();
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

        //BOTON DE LIMPIAR
    document.getElementById("btnLimpiar").addEventListener("click", function() {
        document.getElementById("pagoForm").reset();
    });

    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

@stop

