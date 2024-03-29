

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

<center>
    <div class="logo-container">
        <img class="logo" src="{{ asset('verusuario.png') }}" alt="Logo Microcréditos Mary">
        <h1 class="title">USUARIOS</h1>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
    </div>
</center>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="text-right mt-3">
                    <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                        <i class="fas fa-sign-out-alt fa-lg"></i> Salir
                    </button>
                    <p></p>
                </div>
        </div>
    </div>
    <x-slot name="header">
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #75606069">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered table-sm text-center" style="background-color: white">
                            <thead class="bg-dark">
                                <tr scope="col">
                                    <th scope="col">CARNET</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">USUARIO</th>
                                    <th scope="col">CARGO</th>
                                    <th scope="col">ESTADO</th>
                                    <th scope="col">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Users as $usersv)
                                    <tr>
                                        <td scope="col">{{$usersv->Carnet_usuario}}</td>
                                        <td scope="col">{{$usersv->name}} {{$usersv->apellido_usuario}}</td>
                                        <td scope="col">{{$usersv->Nombre_usuario}}</td>
                                        <td scope="col">{{$usersv->cargo_usuario}}</td>
                                        <td scope="col">
                                            @if($usersv->estado_usuario == 'ACTIVO')
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                           <a href="{{ route('user.editarusuarios', $usersv->id) }}" type="button" class="btn btn-warning"><i class='fas fa-user-edit'></i></a>
                                      {{--       <form action="{{ route('user.eliminarusuarios', $usersv->id) }}" class="d-inline formulario-eliminaru">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> DAR DE BAJA</button>
                                            </form> --}}
                                            @if($usersv->estado_usuario == 'ACTIVO')
                                                <form action="{{ route('user.cambiarEstado', $usersv->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-toggle-on"></i> </button>
                                                </form>
                                            @else
                                                <form action="{{ route('user.cambiarEstado', $usersv->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success"><i class="fas fa-toggle-off"></i> </button>
                                                </form>
                                            @endif
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
    <style>
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
            //BOTON DE SALIR
    document.getElementById('btnSalir').addEventListener('click', function() {
    window.location.href = "{{ route('dashboard') }}";
    });
        </script>
@stop
