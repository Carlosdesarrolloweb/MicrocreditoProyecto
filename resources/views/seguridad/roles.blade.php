@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;font-weight: bold; color: black;">ROLES</h1>
     <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Roles</h1>
        </div>
        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                <i class="fas fa-sign-out-alt fa-lg"></i> Salir
            </button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table id="roles-table" class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol->id }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>
                                @foreach ($rol->permissions as $permiso)
                                    <span class="badge badge-success">{{ $permiso->name }}</span>
                                @endforeach
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
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable();
        });
    </script>
@stop
