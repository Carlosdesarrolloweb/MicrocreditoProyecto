@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">PRESTAMOS REALIZADOS</h1>

    <th>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
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
            <div class="form-group col-md-12">
                <div class="col-md-12 text-right mb-3">
                    <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                        <i class="fas fa-question-circle fa-lg"></i> Ayuda
                    </button>
                    <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                        <i class="fas fa-sign-out-alt fa-lg"></i> Salir
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered table-sm text-center" style="width:100%">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th style="width: 15%">Cliente</th>
                                    <th>Interés</th>
                                    <th>Monto Préstamo</th>
                                    <th style="width: 5%">Plazo (meses)</th>
                                    <th>Cantidad de Cuotas</th>
                                    <th>Cuota</th>
                                    <th>Ganancia</th>
                                    <th>Monto Prestado</th>
                                    <th>Monto Cancelado</th>
                                    <th>Fecha Préstamo</th>
                                    <th>Estado</th>
                                   <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalMontoPrestamo = 0;
                                    $totalGanancia = 0;
                                    $totalCancelado = 0;
                                    $totalmontoPrestado = 0;
                                @endphp
                                @foreach($prestamos as $prestamo)
                                    <tr>
                                        <td>{{ $prestamo->cliente->nombre_cliente }} {{ $prestamo->cliente->apellido_cliente }}</td>
                                        <td>{{ $prestamo->interes->interes_prestamo }}%</td>
                                        <td>Bs.{{ $prestamo->monto_prestamo }}</td>
                                        <td>{{ $prestamo->duracion_prestamo }}</td>
                                        <td>{{ $prestamo->cantidad_cuotas }}</td>
                                        <td>Bs.{{ $prestamo->calculo_cuota }}</td>
                                        <td>Bs.{{ $prestamo->ganancia }}</td>
                                        <td>Bs.{{ $prestamo->monto_prestado }}</td>
                                        <td>Bs.{{ $prestamo->monto_cancelado }}</td>
                                        <td>{{ $prestamo->fecha_prestamo }}</td>
                                        <td>
                                            <span class="badge {{ $prestamo->estado == 0 ? 'badge-warning' : 'badge-success' }}">
                                              {{ $prestamo->estado == 0 ? 'PENDIENTE' : 'PAGADO' }}
                                            </span>
                                          </td>
                                         <td>
                                            <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" class="formulario-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                @if ($prestamo->monto_cancelado == 0)
                                                    <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $totalMontoPrestamo += $prestamo->monto_prestamo;
                                        $totalGanancia += $prestamo->ganancia;
                                        $totalCancelado += $prestamo->monto_cancelado;
                                        $totalmontoPrestado += $prestamo->monto_prestado;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-body bg-warning text-white">
                                <h5 class="card-title"><i class="fas fa-hand-holding-usd"></i> Prestamos Realizados: Bs.{{ $totalMontoPrestamo }}</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body bg-danger text-white">
                                    <h5 class="card-title"><i class="fas fa-money-bill-wave"></i> Total Deudas: Bs.{{ $totalmontoPrestado }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body bg-success text-white">
                                    <h5 class="card-title"><i class="fas fa-coins"></i> Ganancia: Bs.{{ $totalGanancia }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body bg-info text-white">
                                    <h5 class="card-title"><i class="fas fa-check-circle"></i> Dinero Pagado: Bs.{{ $totalCancelado }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body bg-primary text-white">
                                    <h5 class="card-title"><i class="fas fa-exclamation-circle"></i> Deuda General: Bs.{{ $totalmontoPrestado - $totalCancelado }}</h5>
                                    <input type="hidden" name="deuda_general" value="{{ $totalmontoPrestado - $totalCancelado }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .custom-box {
           background-color: #75606069;
           border: 1px solid #ccc;
           padding: 20px;
           border-radius: 5px;
           }
       .custom-modal {
           width: 90% !important;
           max-width: 1200px !important;
           }
   </style>
@stop

@section('js')
    <script src="{{ asset('vendor/jquery-table2excel/dist/jquery.table2excel.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $('th a').click(function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        window.location.href = url;
    });

    $(document).ready(function() {
        $("#download-btn").click(function(e) {
            e.preventDefault();
            var table = $("#prestamos").table2excel({
                filename: "prestamos.xls"
            });
            window.location.href = table;
        });
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('eliminar') == 'ok')
    <script>
        Swal.fire(
            'Eliminado',
            'El Cliente se elimino con exito',
            'success'
            )
    </script>

@endif
@if(session('error'))
<script>
    Swal.fire(
        'Error',
        '{{ session('error') }}',
        'error'
    )
</script>
@endif
    <script>
        $('.formulario-eliminar').submit(function(e){
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
                     // Mostrar mensaje de éxito después de enviar el formulario
                Swal.fire({
                    icon: 'success',
                    title: 'Se elimino correctamente',
                    text: 'Prestamo borrado !'
                });
            }
            })
        });

    </script>

 <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <Script>
        $(document).ready(function () {
        $('#example').DataTable();
        });
    </Script>
    <Script>
        $(document).ready(function () {
        $('#example').DataTable();
        });
    </Script>
    <script>
        //BOTON DE AYUDA
    document.getElementById('btnAyuda').addEventListener('click', function() {
        Swal.fire({
            title: 'Ayuda',
            html: '<embed src="/pdf/vistaprestamos.pdf" type="application/pdf" width="100%" height="800px" />',
            confirmButtonText: 'Cerrar',
            customClass: {
            content: 'modal-lg',
            popup: 'custom-modal'
            }
        });
    });
        //BOTON DE SALIR
    document.getElementById('btnSalir').addEventListener('click', function() {
    window.location.href = "{{ route('dashboard') }}";
    });

        //BOTON DE LIMPIAR
    document.getElementById("btnLimpiar").addEventListener("click", function() {
        document.getElementById("pagoForm").reset();
    });

    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop
