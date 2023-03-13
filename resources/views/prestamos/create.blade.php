


@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
<center>
    <h1>NUEVO PRESTAMO</h1>
</center>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form action="{{ route('prestamos.store') }}" method="POST">
                        @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <label for="id_cliente">Cliente</label>
                            <select name="id_cliente" class="form-control" required>
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_usuario">Usuario que otorga el préstamo</label>
                            <select name="id_usuario" class="form-control" required>
                                <option value="">Seleccione un usuario</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="id_interes">Tipo de Interés</label>
                            <select name="id_interes" id="interes" class="form-control" required>
                                <option value="">Seleccione un tipo de interés</option>
                                @foreach($intereses as $interes)
                                    <option value="{{ $interes->id }}">{{ $interes->interes_prestamo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_modo_pago">Modo de Pago</label>
                            <select name="id_modo_pago" id="id_modo_pago" class="form-control" required>
                                <option value="">Seleccione un modo de pago</option>
                                @foreach($modos_pago as $modo_pago)
                                    <option value="{{ $modo_pago->id }}">{{ $modo_pago->modalidad_pago }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="monto_prestamo">Monto del Préstamo</label>
                            <input type="number" id="monto" name="monto_prestamo" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="duracion_prestamo">Duración del Préstamo (en meses)</label>
                            <input type="number" id="duracion" name="duracion_prestamo" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="cantidad_cuotas">Cantidad de Cuotas</label>
                            <input type="number" id="cantidad_cuotas" name="cantidad_cuotas" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="calculo_cuota">Cálculo de Cuota</label>
                            <input type="number" id="calculo_cuota" name="calculo_cuota" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="monto_prestado">Monto Prestado</label>
                            <input type="number" id="monto_prestado" name="monto_prestado" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="monto_cancelado">Monto Cancelado</label>
                            <input type="number" id="monto_cancelado" name="monto_cancelado" class="form-control" required>
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
        const interes = parseFloat(input1.value)/100;
        const modo_pago = parseFloat(input2.value);
        const monto = parseFloat(input3.value);
        const duracion = parseFloat(input4.value);
        const cantidad_cuotas = parseFloat(input5.value);

        // Calculamos la cuota
       // const cuota = ((monto * interes) + monto) / (cantidad_cuotas * modo_pago);
        const cuota = ((monto / cantidad_cuotas) + (interes/cantidad_cuotas));
        // Actualizamos el valor del input "calculo_cuota"
        input6.value = cuota.toFixed(2);
    }

    function actualizarMontoPrestado() {
        const interes = parseFloat(input1.value)/100;
        const monto = parseFloat(input3.value);
        const monto_prestado = monto * (1 + interes);

       /*  const monto_prestado = (cuota * cantidad_cuotas); */


        input7.value = monto_prestado.toFixed(2);
        input8.value = "0.00";
    }
</script>

@stop
