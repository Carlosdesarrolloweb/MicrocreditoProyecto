

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 style="text-align: center;">CLIENTES REGISTRADOS </h1>

@stop

@section('content')

    <x-slot name="header">
        <h1 class="text-gray-900">crudddddddd</h1>
    </x-slot>
     <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-x1 sm:rounded-lg px-4 py-4">

        <div>
            <form action="" method="get">
                <div class="form-row">
                <div class="col-sm-4"  >
                    <input type="text" class="form-control" name="texto" value="">
                </div>
                <div class="col-auto">
                    <input type="submit" class="btn btn-primary" value="Buscar">
                </div>
                </div>

            </form>
        </div>
        <p>

        </p>

      <!-- tabla base de datos abajo -->
        <table class="table">
        <thead class="bg-dark">
            <tr scope="col">

            <th scope="col">CARNET</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDO</th>
            <th scope="col">EMAIL</th>
            <th scope="col">ESTADO</th>
            <th scope="col">IMAGENES</th>

            </tr>
        </thead>
        <tbody>
            @foreach($Clientes as $clientesv)
            <tr>

                <td scope="col">{{$clientesv->Carnet_cliente}}</td>
                <td scope="col">{{$clientesv->nombre_cliente}}</td>
                <td scope="col">{{$clientesv->apellido_cliente}}</td>
                <td scope="col">{{$clientesv->email_cliente}}</td>
                <td scope="col">{{$clientesv->estado_cliente}}</td>

                <td>
                    <img src="{{$clientesv->foto->direccion_imagen}}" width="75px" height="75px" onclick="mostrarimagen('<?= $clientesv->foto->direccion_imagen;?>','FOTO CARNET ANVERSO')" >
                    <img src="{{$clientesv->fotocarnet->direccion_imagen}}" width="75px" height="75px" onclick="mostrarimagen('<?= $clientesv->fotocarnet->direccion_imagen;?>','FOTO CARNET REVERSO')">
                    <img src="{{$clientesv->fotorecibo ->direccion_imagen}}" width="75px" height="75px" onclick="mostrarimagen('<?= $clientesv->fotorecibo->direccion_imagen;?>','FOTO RECIBO')">
                    <img src="{{$clientesv->fotocroquis->direccion_imagen}}" width="75px" height="75px" onclick="mostrarimagen('<?= $clientesv->fotocroquis->direccion_imagen;?>','FOTO CROQUIS')">
                </td>
                <td>

                <a  href="{{ route('clientes.editarclientes',$clientesv->id) }}"  type="button" class="btn btn-warning"><i class='fas fa-user-edit'></i> EDITAR </a>
                <form action="{{ route('clientes.eliminarclientes',$clientesv->id) }}" class="d-inline formulario-eliminar">

                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger" > <i class='fa fa-trash'></i> ELIMINAR</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">T??tulo del modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img id="mi_imagen"/>
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

    <script> console.log('Hi!'); </script>
    <script>
     function mostrarimagen(url,titulo) {
        $("#mi_imagen").attr("src",url);
        $('#exampleModalLabel').html(titulo);
        $('#exampleModal').modal('show');
    }

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

