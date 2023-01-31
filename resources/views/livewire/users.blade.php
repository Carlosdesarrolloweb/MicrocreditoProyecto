

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="fw-bold">Usuarios Registrados </h1>
@stop

@section('content')

    <x-slot name="header">
        <h1 class="text-gray-900">crudddddddd</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-x1 sm:rounded-lg px-4 py-4">
            
            

        
            
        <table class="table">
        <thead>
            <tr scope="col">
            <th scope="col">ID</th>
            <th scope="col">CARNET</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDO</th>
            <th scope="col">USUARIO</th>
            <th scope="col">CARGO</th>
            <th scope="col">EMAIL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Users as $usersv)
            <tr>
                <td scope="col">{{$usersv->id}}</td>
                <td scope="col">{{$usersv->Carnet_usuario}}</td>
                <td scope="col">{{$usersv->name}}</td>
                <td scope="col">{{$usersv->apellido_usuario}}</td>
                <td scope="col">{{$usersv->Nombre_usuario}}</td>
                <td scope="col">{{$usersv->cargo_usuario}}</td>
                <td scope="col">{{$usersv->email}}</td>
                <td>
                
                <a  href="{{ route('user.editarusuarios',$usersv->id) }}"  type="button" class="btn btn-warning">EDITAR</a>   
                 <form action="{{ route('user.eliminarusuarios',$usersv->id) }}" class="d-inline formulario-eliminaru">

                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>



                </td>
        
            </tr>
            @endforeach


        </tbody>


        </table>
            </div>
        </div>
    </div> 

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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