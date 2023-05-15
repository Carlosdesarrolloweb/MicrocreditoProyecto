@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1 style="text-align: center;font-weight: bold; color: black;">GARANTIAS</h1>

    <th>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
    </th>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
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
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                         <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Garantía</th>
                                    <th>Valor Prenda</th>
                                    <th>Detalle Prenda</th>
                                    <th>Cliente</th>
                                    <th>Prestamo</th>
                                    <th>Fecha de Entrega</th>
                                    <th>Estado</th>
                                     {{--        <th>Imagen</th> --}}
                                    <th>Acciones</th> <!-- Columna para los botones -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($garantias as $garantia)
                                    <tr>
                                        {{-- <td>{{ $garantia->id }}</td> --}}
                                        <td>{{ $garantia->garantia }}</td>
                                        <td>{{ $garantia->Valor_Prenda }}</td>
                                        <td>{{ $garantia->Detalle_Prenda }}</td>
                                        <td>{{ $garantia->cliente->nombre_cliente }} {{ $garantia->cliente->apellido_cliente }}</td>
                                        <td>{{ $garantia->id_prestamo }}</td>
                                        <td>{{ $garantia->fecha_entrega }}</td>
                                        <td>{{ $garantia->estado }}</td>
                                        {{--<td><img src="{{ asset($garantia->imagen) }}" width="50"></td>
                                        <td> <img src="{{$garantia->foto->direccion_imagen}}" width="75px" height="75px" onclick="mostrarimagen('<?= $garantia->foto->direccion_imagen;?>','FOTO CARNET ANVERSO')" > --}}
                                        <td>
                                            <a href="{{ route('garantias.edit', $garantia->id) }}" class="btn btn-warning"><i class='fas fa-user-edit'></i> EDITAR </a>
                                            <form action="{{ route('garantias.destroy', $garantia->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-eliminar" data-id="{{ $garantia->id }}"> <i class='fa fa-trash'></i> ELIMINAR</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                                <center>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Título del modal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="mi_imagen"/>
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
    @stop

    @section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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

    <Script>
    $(document).ready(function () {
    $('#example').DataTable();
    });
    </Script>

    @stop
