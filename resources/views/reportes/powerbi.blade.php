





@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@livewireStyles
<link rel="stylesheet" href="{{ asset('vendor/powergrid/powergrid.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@stop

@section('content')
 <div class="container">
    <div class="style:bg-red">
        <iframe title="REPORTEPRESTAMOS" width="1400" height="1000" src="https://app.powerbi.com/reportEmbed?reportId=089e77df-542d-4172-b65b-518c460a81ff&autoAuth=true&ctid=b690017d-ae11-42b5-9f37-74728c6d266d" frameborder="0" allowFullScreen="true"></iframe>


      </div>
    </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vendor/powergrid/powergrid.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.4.2/cdn.min.js"></script>
         <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    @stop
