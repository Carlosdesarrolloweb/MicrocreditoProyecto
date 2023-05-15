

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">USUARIOS REGISTRADOS</h1>

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
                                        {{--<td>
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
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
        <Script>
            $(document).ready(function () {
            $('#example').DataTable();
            });
        </Script>
@stop
