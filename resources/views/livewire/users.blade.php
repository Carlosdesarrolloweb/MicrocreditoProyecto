

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')

    <table class="table-fixed w-full">
        <thead>
            <tr class="bg-indigo-600 text-Black">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">CARNET</th>
            <th class="px-4 py-2">NOMBRE</th>
            <th class="px-4 py-2">APELLIDO</th>
            <th class="px-4 py-2">USUARIO</th>
            <th class="px-4 py-2">TELEFONO</th>
            <th class="px-4 py-2">EMAIL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Users as $usersv)
            <tr>
                <td class="px-4 py-2">{{$usersv->id}}</td>
                <td class="px-4 py-2">{{$usersv->Carnet_usuario}}</td>
                <td class="px-4 py-2">{{$usersv->name}}</td>
                <td class="px-4 py-2">{{$usersv->apellido_usuario}}</td>
                <td class="px-4 py-2">{{$usersv->Nombre_usuario}}</td>
                <td class="px-4 py-2">{{$usersv->telefono_usuario}}</td>
                <td class="px-4 py-2">{{$usersv->email}}</td>
        
            </tr>
            @endforeach


        </tbody>


    </table>
            

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop