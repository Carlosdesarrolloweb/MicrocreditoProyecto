


@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">NUEVO PRESTAMO</h1>
</center>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}.  . {{ $cliente->Carnet_cliente }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_usuario">Usuario que otorga el préstamo</label>
                            <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">
                            <input type="text" class="form-control" value="{{ Auth::user()->name . ' ' . Auth::user()->apellido_usuario }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="id_interes">Tipo de Interés</label>
                            <select name="id_interes" id="interes" class="form-control" required>
                                <option value="">Seleccione un tipo de interés</option>
                                @foreach($intereses as $interes)
                                    <option value="{{ $interes->interes_prestamo }}">{{ $interes->interes_prestamo }}%</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_modo_pago">Modo de Pago</label>
                            <select name="id_modo_pago" id="id_modo_pago" class="form-control" required>
                                <option value="">Seleccione un modo de pago</option>
                                @foreach($modo_pago as $modos_pago)
                                    <option value="{{ $modos_pago->id }}">{{ $modos_pago->modalidad_pago }}</option>
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
                            <label for="ganancia">Ganancia</label>
                            <input type="number" id="ganancia" name="garantia" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="monto_prestado">Monto Prestado</label>
                            <input type="number" id="monto_prestado" name="monto_prestado" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="monto_cancelado">Monto Cancelado</label>
                            <input type="number" id="monto_cancelado" name="monto_cancelado" class="form-control" readonly>
                        </div>
                    </div>
                            <p><p>
                            </p></p>
                            <div class="flex items-center justify-end mt-4">
                                 <x-jet-button class="btn btn-success btn-lg mb-2" onclick="Swal.fire('Good job!', 'You clicked the button!', 'success')">
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



/* $(document).ready(function() {
    $('#busqueda_cliente').on('keyup', function(){
        var query = $(this).val();
        $.ajax({
            url:"{{ route('clientes.buscar') }}",
            type:"GET",
            data:{'query':query},
            success:function (data) {
                $('#resultados_busqueda').html(data);
            }
        })
    })
}); */






</script>



@stop
