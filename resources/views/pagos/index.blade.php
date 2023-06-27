@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
    <center>
        <h1 style="text-align: center;font-weight: bold; color: black;">PAGOS REALIZADOS</h1>

        <th>
            <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ date('d/m/Y') }}</P>
        </th>

    </center>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <div class="form-group">
                </div>
                <div class="table-responsive">
                   {{--  <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead class="bg-dark text-white">
                                <tr>
                                    <th>Cliente</th>
                                    <th>Prestamo</th>
                                    <th>Fecha de pago</th>
                                    <th>Monto de pago</th>
                                    <th>Deuda actual</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th> <!-- Agregamos una nueva columna para las acciones -->
                                </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $deudasActuales = [];
                                    @endphp

                                @foreach ($pagos as $pago)
                                        @php
                                            $prestamoId = $pago->prestamo->id;

                                                // Verificar si la deuda actual ya existe en la matriz
                                            $deudaActual = isset($deudasActuales[$prestamoId]) ? $deudasActuales[$prestamoId] : $pago->prestamo->monto_prestamo;

                                                // Calcular la nueva deuda actual
                                            $deudaActual -= $pago->monto_pago;

                                                // Almacenar la nueva deuda actual en la matriz
                                            $deudasActuales[$prestamoId] = $deudaActual;
                                        @endphp
                                    <tr>
                                        <td>{{ $pago->prestamo->cliente->nombre_cliente }} {{ $pago->prestamo->cliente->apellido_cliente }}</td>
                                        <td>{{ $pago->prestamo->monto_prestamo }}</td>
                                        <td>{{ $pago->fecha_pago }}</td>
                                        <td>{{ $pago->monto_pago }}</td>
                                        <td>{{ $deudaActual }}</td>
                                        <td>{{ $pago->descripcion }}</td>
                                        <td>
                                            <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-warning btn-edit">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table> --}}

                            <table id="example" class="table table-striped table-bordered table-sm text-center" style="width:100%">
                                <thead class="bg-dark text-white">
                                  <tr>
                                    <th>Cliente</th>
                                    <th>Prestamo</th>
                                    <th>Fecha de pago</th>
                                    <th>Monto de pago</th>
                                    <th>Deuda actual</th>
                                    <th>Descripción</th>
                                    <th>Estado Pago</th> <!-- Nueva columna para el estado de pago -->
                                    <th>Acciones</th> <!-- Agregamos una nueva columna para las acciones -->
                                  </tr>
                                </thead>
                                <tbody>
                                  @php
                                    $deudasActuales = [];
                                  @endphp
                                  @foreach ($pagos as $pago)
                                    @php
                                      $prestamoId = $pago->prestamo->id;
                                      $deudaActual = isset($deudasActuales[$prestamoId]) ? $deudasActuales[$prestamoId] : $pago->prestamo->monto_prestamo;
                                      $deudaActual -= $pago->monto_pago;
                                      $deudasActuales[$prestamoId] = $deudaActual;
                                    @endphp
                                    <tr>
                                      <td>{{ $pago->prestamo->cliente->nombre_cliente }} {{ $pago->prestamo->cliente->apellido_cliente }}</td>
                                      <td>{{ $pago->prestamo->monto_prestamo }}</td>
                                      <td>{{ $pago->fecha_pago }}</td>
                                      <td>{{ $pago->monto_pago }}</td>
                                      <td>{{ $deudaActual }}</td>
                                      <td>{{ $pago->descripcion }}</td>
                                      <td style="color: #000000; background-color: {{ $pago->prestamo->estado == 1 ? '#00b347' : 'white' }}">
                                        {{ $pago->prestamo->estado == 1 ? 'DEUDA CANCELADA' : '' }}
                                      </td>
                                      <td>
                                        <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-warning btn-edit">Editar</a>
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
@stop

@section('js')
    <script src="{{ asset('vendor/jquery-table2excel/dist/jquery.table2excel.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            var clienteSelect = $('#id_cliente');
            var tableBody = $('#example tbody');

            clienteSelect.change(function() {
                var clienteId = $(this).val();

                $.ajax({
                    url: "{{ route('pagos.obtenerPagosPorCliente', ':clienteId') }}".replace(':clienteId', clienteId),
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        tableBody.empty();

                        if (response.pagos && response.pagos.length > 0) {
                            response.pagos.forEach(function(pago) {
                                var row = `
                                    <tr>
                                        <td>${pago.prestamo.cliente.nombre_cliente} ${pago.prestamo.cliente.apellido_cliente}</td>
                                        <td>${pago.prestamo.monto_prestamo}</td>
                                        <td>${pago.fecha_pago}</td>
                                        <td>${pago.monto_pago}</td>
                                        <td>${pago.deuda_actual}</td>
                                        <td>${pago.descripcion}</td>
                                        <td>
                                            <a href="{{ route('pagos.edit', ['id' => ':id']) }}".replace(':id', pago.id) class="btn btn-warning btn-edit">Editar</a>
                                        </td>
                                    </tr>
                                `;

                                tableBody.append(row);
                            });
                        } else {
                            var noDataRow = `
                                <tr>
                                    <td colspan="7">No se encontraron pagos para este cliente.</td>
                                </tr>
                            `;
                            tableBody.append(noDataRow);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
    <Script>
        $(document).ready(function () {
        $('#example').DataTable();
        });
    </Script>
@stop
