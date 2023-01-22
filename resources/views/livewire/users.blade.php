

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios Registrados</h1>
@stop

@section('content')

    <x-slot name="header">
        <h1 class="text-gray-900">crudddddddd</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-x1 sm:rounded-lg px-4 py-4">
            
            <button  type="button" class="btn btn-success" wire:click="crear(register)">NUEVO</button>

            
        <table class="table">
        <thead>
            <tr scope="col">
            <th scope="col">ID</th>
            <th scope="col">CARNET</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDO</th>
            <th scope="col">USUARIO</th>
            <th scope="col">TELEFONO</th>
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
                <td scope="col">{{$usersv->telefono_usuario}}</td>
                <td scope="col">{{$usersv->email}}</td>
                <td>
                    <button type="button" class="btn btn-primary">EDITAR</button>
                    <button  wire:click="eliminar({{$usersv->id}})" type="button" class="btn btn-danger">ELIMINAR</button>
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
@stop