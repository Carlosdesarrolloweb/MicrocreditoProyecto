<!-- Archivo: resources/views/loans/create.blade.php -->
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">REGISTRAR NUEVO PRESTAMO</h1>
</center>
@stop

@section('content')

                <p>
                    <p>

                    </p>
                </p>

        <form action="" method="POST">
            @csrf

            <div class="container">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="client">CLIENTE</label>
                        <input type="text" class="form-control" id="client" name="client">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="amount">MONTO PRESTADO</label>
                        <input type="text" class="form-control" id="amount" name="amount">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="payment_mode">MODO DE PAGO</label>
                                <select class="form-control" id="payment_mode" name="payment_mode">
                                <option value="daily">DIARIO</option>
                                <option value="weekly">SEMANAL</option>
                                <option value="weekly">QUINCENAL</option>
                                <option value="monthly">MENSUAL</option>
                                </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                                <label for="interest_rate">INTERES %</label>
                                <input type="text" class="form-control" id="interest_rate" name="interest_rate">
                    </div>

                    <div class="form-group col-md-6">
                                <label for="number_of_installments">CANTIDAD DE CUOTAS</label>
                                <input type="text" class="form-control" id="number_of_installments" name="number_of_installments">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                                <label for="loan_profit">GANANCIA</label>
                                <input type="text" class="form-control" id="loan_profit" name="loan_profit">
                    </div>

                    <div class="form-group col-md-6">
                                <label for="start_date">FECHA INICIO PRESTAMO</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="number_of_installments">TOTAL A PAGAR</label>
                        <input type="text" class="form-control" id="number_of_installments" name="number_of_installments">
                    </div>
                </div>

                            <button type="submit" class="btn btn-success">REGISTRAR</button>
                            </form>

    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    <script> console.log('Hi!'); </script> -->
    @stop
