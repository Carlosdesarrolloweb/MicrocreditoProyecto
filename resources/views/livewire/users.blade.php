

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">USUARIOS REGISTRADOS</h1>
@stop

@section('content')
<div class="container">
    <center>
    <x-slot name="header">
        <h1 class="text-gray-900">crudddddddd</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-x1 sm:rounded-lg px-4 py-4">





        <table class="table">
        <thead class="bg-dark">
            <tr scope="col">
            {{-- <th scope="col">ID</th> --}}
            <th scope="col">CARNET</th>
            <th scope="col">NOMBRE</th>
            {{-- <th scope="col">APELLIDO</th> --}}
            <th scope="col">USUARIO</th>
            <th scope="col">CARGO</th>
            <th scope="col">ESTADO</th>
            <th scope="col" >  ACCIONES </th>
            </tr>
        </thead>
        <tbody>
            @foreach($Users as $usersv)
            <tr>
                {{-- <td scope="col">{{$usersv->id}}</td> --}}
                <td scope="col">{{$usersv->Carnet_usuario}}</td>
                <td scope="col">{{$usersv->name}} {{$usersv->apellido_usuario}}</td>
                {{-- <td scope="col">{{$usersv->apellido_usuario}}</td> --}}
                <td scope="col">{{$usersv->Nombre_usuario}}</td>
                <td scope="col">{{$usersv->cargo_usuario}}</td>
                <td scope="col">{{$usersv->estado_usuario}}</td>
          {{--       <td>
                    @if($usersv->estado_usuario == 'activo')
                        <span class="badge badge-success">Activo</span>
                            <form action="{{ route('user.updateEstado', [$usersv->id, 'inactivo']) }}" method="POST"> @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">Cambiar estado</button>
                        </form>
                    @else
                        <span class="badge badge-danger">Inactivo</span>
                            <form action="{{ route('user.updateEstado', [$usersv->id, 'activo']) }}" method="POST"> @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Cambiar estado</button>
                        </form>
                    @endif
                </td> --}}
                <td>

                <a  href="{{ route('user.editarusuarios',$usersv->id) }}"  type="button" class="btn btn-warning"><i class='fas fa-user-edit'></i> EDITAR</a>
                 <form action="{{ route('user.eliminarusuarios',$usersv->id) }}" class="d-inline formulario-eliminaru">

                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> DAR DE BAJA</button>
                </form>

                </td>

            </tr>
            @endforeach


        </tbody>


        </table>
            </div>
        </div>
    </div>

</center>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>


     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('eliminaru') == 'ok')
        <script>
            Swal.fire(
                'Eliminado',
                'El Usuario se elimino con exito',
                'success'
                )
        </script>

    @endif

        <script>
            $('.formulario-eliminaru').submit(function(e){
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
