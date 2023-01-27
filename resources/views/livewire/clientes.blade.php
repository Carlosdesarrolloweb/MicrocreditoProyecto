

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="fw-bold">CLIENTES REGISTRADOS </h1>
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
          
            <th scope="col">CARNET</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDO</th>
            <th scope="col">EMAIL</th>
            <th scope="col">ESTADO</th>
          
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

                <a  href="{{ route('clientes.editarclientes',$clientesv->id) }}"  type="button" class="btn btn-warning">EDITAR</a>
                    <a  href="{{ route('clientes.eliminarclientes',$clientesv->id) }}"  type="button" class="btn btn-danger">ELIMINAR</a>
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