@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<center>
    <div class="logo-container">
        <img class="logo" src="{{ asset('garantias.png') }}" alt="Logo Microcréditos Mary">
        <h1 class="title">GARANTIAS</h1>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
    </div>
</center>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css" />
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
            <div class="card" style="background-color: #75606069">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered table-sm text-center" style="background-color: white">
                            <thead class="bg-dark text-white">
                                <tr scope="col">
                                    <th>Garantía</th>
                                    <th>Valor Prenda</th>
                                    <th>Detalle Prenda</th>
                                    <th>Cliente</th>
                                    <th>Prestamo</th>
                                    <th>Fecha de Entrega</th>
                                    <th>Estado</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th> <!-- Columna para los botones -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($garantias as $garantia)
                                    <tr>
                                        {{-- <td>{{ $garantia->id }}</td> --}}
                                        <td >{{ $garantia->garantia }}</td>
                                        <td >{{ $garantia->Valor_Prenda }}</td>
                                        <td >{{ $garantia->Detalle_Prenda }}</td>
                                        <td >{{ $garantia->cliente->nombre_cliente }} {{ $garantia->cliente->apellido_cliente }}</td>
                                        <td >{{ $garantia->id_prestamo }}</td>
                                        <td >{{ $garantia->fecha_entrega }}</td>
                                        <td>
                                            <span class="badge
                                              @if($garantia->estado == 'ARTICULO NUEVO') badge-success
                                              @elseif($garantia->estado == 'ARTICULO USADO') badge-warning
                                              @endif">
                                              {{ $garantia->estado }}
                                            </span>
                                          </td>
                                        <td >
                                            <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal"  data-img="{{asset($garantia->foto->direccion_imagen) }}" data-title="GARANTIA">
                                                <i class="fas fa-image"></i>
                                            </button>
                                        <td>
                                            <a href="{{ route('garantias.edit', $garantia->id) }}" class="btn btn-warning"><i class='fas fa-user-edit'></i>  </a>
                                            <form action="{{ route('garantias.destroy', $garantia->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-eliminar" data-id="{{ $garantia->id }}"> <i class='fa fa-trash'></i> </button>
                                            </form>
                                            <a href="{{ route('pdf.garantia', $garantia->id) }}" class="btn btn-primary"><i class="far fa-file-pdf"></i>
                                                PDF
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <center>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered custom-modal-xl">
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
        .custom-modal-xl {
            max-width: 200%;
            width: 95%;
            max-height: 90%;
            height: 90%;
        }

        .custom-modal-xl .modal-dialog {
            max-width: 95%;
        }

        .custom-modal-xl .modal-content {
            width: 100%;
        }
        .custom-modal-xl .modal-content img {
            object-fit: contain;
        }
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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/powergrid/powergrid.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <Script>
       $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrados de _MAX_ registros totales)",
                "search" : 'Buscar',
                "paginate" : {
                    'next' : 'Siguiente',
                    'previous':'Anterior'

                }
            }
        });
    });
    </Script>
    <script>
        $(document).ready(function() {
            $('.btn-eliminar').click(function(event) {
                event.preventDefault();
                const id = $(this).data('id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/garantias/' + id,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: id
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire(
                                        'Eliminado',
                                        'El elemento ha sido eliminado',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error',
                                        'Ocurrió un error al eliminar el elemento',
                                        'error'
                                    );
                                }
                            },
                            error: function(data) {
                                Swal.fire(
                                    'Error',
                                    'Ocurrió un error al eliminar el elemento',
                                    'error'
                                );
                            }
                        });
                    }
                });
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
    <script>
        function mostrarimagen(url,titulo)
        {
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

    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#exampleModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var imgSrc = button.data('img');
                    var modal = $(this);

                    modal.find('.modal-body img').attr('src', imgSrc);

                    // Habilitar el zoom en la imagen
                    modal.find('.modal-body img').zoom();
                });
            });
        </script>

@stop
