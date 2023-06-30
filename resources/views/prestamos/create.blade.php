


@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">NUEVO PRESTAMO</h1>

    <th>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
    </th>

</center>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="custom-box">
                <div class="box-body">
                        <form action="{{ route('prestamos.store') }}" method="POST" id="prestamoForm">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="id_cliente"> <i class="fas fa-user"></i> Cliente</label>
                                    <select name="id_cliente" class="form-control" required>
                                        <option value="">Seleccione un cliente</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}.  . {{ $cliente->Carnet_cliente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="id_usuario"><i class="fas fa-user"></i> Usuario que otorga el préstamo</label>
                                    <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">
                                    <input type="text" class="form-control" value="{{ Auth::user()->name . ' ' . Auth::user()->apellido_usuario }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><p></p>
                                    <label for="id_interes"><i class="fas fa-percentage"></i> Tipo de Interés</label>
                                    <select name="id_interes" id="interes" class="form-control" required>
                                        <option value="">Seleccione un tipo de interés</option>
                                        @foreach($intereses as $interes)
                                            <option value="{{ $interes->interes_prestamo }}">{{ $interes->interes_prestamo }}%</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6"><p></p>
                                    <label for="id_modo_pago"><i class="fas fa-money-check"></i> Modo de Pago</label>
                                    <select name="id_modo_pago" id="id_modo_pago" class="form-control" required>
                                        <option value="">Seleccione un modo de pago</option>
                                        @foreach($modo_pago as $modos_pago)
                                            <option value="{{ $modos_pago->id }}">{{ $modos_pago->modalidad_pago }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><p></p>
                                    <label for="monto_prestamo"><i class="fas fa-dollar-sign"></i> Monto del Préstamo</label>
                                    <input type="number" id="monto" name="monto_prestamo" class="form-control" required><p></p>
                                </div>

                                <div class="col-md-6"><p></p>
                                    <label for="duracion_prestamo"><i class="far fa-calendar-alt"></i> Duración del Préstamo (en meses)</label>
                                    <input type="number" id="duracion" name="duracion_prestamo" class="form-control" required><p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="cantidad_cuotas"><i class="fas fa-sort-numeric-up"></i> Cantidad de Cuotas</label>
                                    <input type="number" id="cantidad_cuotas" name="cantidad_cuotas" class="form-control" required><p></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="calculo_cuota"><i class="fas fa-calculator"></i> Cálculo de Cuota</label>
                                    <input type="number" id="calculo_cuota" name="calculo_cuota" class="form-control" readonly><p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="ganancia"><i class="fas fa-chart-line"></i> Ganancia</label>
                                    <input type="number" id="ganancia" name="ganancia" class="form-control" readonly><p></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="monto_prestado"><i class="fas fa-money-bill"></i> Monto Prestado</label>
                                    <input type="number" id="monto_prestado" name="monto_prestado" class="form-control" readonly><p></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="monto_cancelado"><i class="fas fa-money-bill"></i> Monto Cancelado</label>
                                    <input type="number" id="monto_cancelado" name="monto_cancelado" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p></p>
                                    <label for="fecha_prestamo"><i class="far fa-calendar-alt"></i> Fecha Prestamo</label>
                                    <?php date_default_timezone_set('America/La_Paz'); ?>
                                    <input type="text" id="fecha_prestamo" name="fecha_prestamo" class="form-control datepicker" value="<?= date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <p><p>
                            </p></p>
                            <div class="flex items-center justify-end mt-4">
                                <x-jet-button class="btn btn-success btn-lg mb-2">
                                    <i class='fa fa-user-plus'></i>
                                    {{ __('REGISTRAR PRESTAMO') }}
                                </x-jet-button>
                            </div>
                        </form>
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
    </style>
@stop

@section('js')
 <script>
    // Seleccionamos los inputs
    const input1 = document.getElementById("interes");
    const input2 = document.getElementById("id_modo_pago");
    const input3 = document.getElementById("monto");
    const input4 = document.getElementById("duracion");
    const input5 = document.getElementById("cantidad_cuotas");
    const input6 = document.getElementById("calculo_cuota");
    const input7 = document.getElementById("monto_prestado");
    const input8 = document.getElementById("monto_cancelado");

    // Agregamos un listener para el evento input en cada input
    input1.addEventListener("input", () => {
        calcularCuota();
    });

    input2.addEventListener("input", () => {
        calcularCuota();
    });

    input3.addEventListener("input", () => {
        calcularCuota();
        actualizarMontoPrestado();
    });

    input4.addEventListener("input", () => {
        calcularCuota();
    });

    input5.addEventListener("input", () => {
        calcularCuota();
    });
    // Definimos la función para calcular la cuota
    function calcularCuota() {
        const interes = input1.value;
        const monto = input3.value;
        const cantidad_cuotas = input5.value;
        let cuota = 0;
        let ganancia = 0;
        if (interes !== "" && monto !== "" && cantidad_cuotas !== "") {
            const interes_decimal = parseFloat(interes) / 100;
            console.log(interes_decimal);
            ganancia = parseFloat(monto) * interes_decimal;
             console.log(ganancia);
            const deuda_total = parseFloat(monto) + ganancia;
            cuota = deuda_total / parseFloat(cantidad_cuotas);
        }
        input6.value = cuota.toFixed(2);
        input7.value = (parseFloat(monto) + ganancia).toFixed(2);
        input8.value = "0.00";
        document.getElementById("ganancia").value = ganancia.toFixed(2);
    }

    function actualizarMontoPrestado() {
        const interes = parseFloat(input1.value)/100;
        const monto = parseFloat(input3.value);
        const monto_prestado = monto * (1 + interes);

        input7.value = monto_prestado.toFixed(2);
        input8.value = "0.00";
    }
         // ALERTA DEL BOTON GUARDAR

    $(document).ready(function() {
        $('#prestamoForm').submit(function(e) {
        e.preventDefault(); // previene el envío del formulario

        // Mostrar alerta de confirmación antes de enviar el formulario
        Swal.fire({
            title: 'Esta Seguro?',
            text: "Se Registrara un Prestamo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Otorgar Prestamo!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario
                this.submit();

                // Mostrar mensaje de éxito después de enviar el formulario
                Swal.fire({
                    icon: 'success',
                    title: 'Prestamo Registrado',
                    text: 'Tu registro ha sido guardado exitosamente.'
                });
            }
        });
    });
});
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

@stop
