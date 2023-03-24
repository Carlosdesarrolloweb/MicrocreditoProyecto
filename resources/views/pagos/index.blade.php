@extends('adminlte::page')

@section('title', 'Registrar Pagos')

@section('content_header')
    <h1>Registrar Pagos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Agregar Pago</h3>
                </div>
                <form role="form" method="post" action="{{ route('pagos.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="cliente_id">ID del Cliente</label>
                            <input type="text" class="form-control" id="cliente_id" name="cliente_id">
                        </div>

                        <div id="monto_cuota">
                            <!-- aquí se mostrará el monto de cuota -->
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Registrar Pago</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Pagos</h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID del Pago</th>
                                <th>ID del Cliente</th>
                                <th>Fecha de Pago</th>
                                <th>Monto Pagado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pagos as $pago)
                                <tr>
                                    <td>{{ $pago->id }}</td>
                                    <td>{{ $pago->cliente_id }}</td>
                                    <td>{{ $pago->fecha_pago }}</td>
                                    <td>{{ $pago->monto_pagado }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#cliente_id').on('input', function() {
                var cliente_id = $(this).val();
                $.ajax({
                    url: '{{ route('pagos.getMontoCuota') }}',
                    type: 'GET',
                    data: { cliente_id: cliente_id },
                    success: function(response) {
                        $('#monto_cuota').html('Monto de Cuota: $' + response.monto_cuota);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@stop
