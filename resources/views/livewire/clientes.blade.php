

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">CLIENTES</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</th>
@livewireStyles
<link rel="stylesheet" href="{{ asset('vendor/powergrid/powergrid.css') }}">

@stop

@section('content')
<div class="container-fluid">
    <x-slot name="header">
        <h1 class="text-gray-900">crudddddddd</h1>
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Buscar cliente') }}</div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-row">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="texto" value="">
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="btn btn-primary" value="Buscar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="bg-dark text-white">
                                <tr scope="col" >
                                    <th scope="col">CARNET</th>
                                    <th scope="col">NOMBRE </th>
                                    <th scope="col">ZONA</th>
                                    <th scope="col">ESTADO</th>
                                    <th scope="col">IMÁGENES</th>
                                    <th scope="col">EDITAR</th>
                                    <th scope="col">ELIMINAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Clientes as $clientesv)
                                <tr>
                                    <td scope="col">{{$clientesv->Carnet_cliente}}</td>
                                    <td scope="col">{{$clientesv->nombre_cliente}} {{$clientesv->apellido_cliente}}</td>
                                    <td scope="col">{{$clientesv->zona->nombre_zona}}</td>
                                    <td scope="col" @if($clientesv->estado_cliente == 'DEUDA PENDIENTE') class="bg-warning text-dark" @elseif($clientesv->estado_cliente == 'DEUDOR MOROSO') class="bg-danger text-white" @elseif($clientesv->estado_cliente == 'DEUDA CANCELADA') class="bg-success text-white" @endif>{{$clientesv->estado_cliente}}</td>
                                    <td>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-img="{{$clientesv->foto->direccion_imagen}}" data-title="FOTO CARNET ANVERSO">
                                            <i class="fas fa-image"></i>
                                        </button>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-img="{{$clientesv->fotocarnet->direccion_imagen}}" data-title="FOTO CARNET ANVERSO">
                                            <i class="fas fa-image"></i>
                                        </button>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-img="{{$clientesv->fotorecibo->direccion_imagen}}" data-title="FOTO CARNET ANVERSO">
                                            <i class="fas fa-image"></i>
                                        </button>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-img="{{$clientesv->fotocroquis->direccion_imagen}}" data-title="FOTO CARNET ANVERSO">
                                            <i class="fas fa-image"></i>
                                            <td>
                                                <a href="{{ route('clientes.editarclientes',$clientesv->id) }}" type="button" class="btn btn-warning"><i class='fas fa-user-edit'></i> EDITAR </a>
                                            </td>

                                            <td>
                                                <form action="{{ route('clientes.eliminarclientes',$clientesv->id) }}" class="d-inline formulario-eliminar">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> ELIMINAR</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
  .thumbnail {
    border: none;
    padding: 0px;
}

.modal-dialog {
    max-width: 100%;
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


    </style>
@stop

@section('js')
@livewireScripts

<script src="{{ asset('vendor/powergrid/powergrid.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
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
@stop

