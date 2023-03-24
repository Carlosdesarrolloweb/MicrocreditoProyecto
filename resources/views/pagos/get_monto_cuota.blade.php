@extends('adminlte::page')

@section('title', 'Obtener Monto de Cuota')

@section('content_header')
    <h1>Obtener Monto de Cuota</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form id="form-obtener-monto-cuota">
                <div class="form-group">
                    <label for="cliente_id">ID del Cliente:</label>
                    <input type="text" class="form-control" id="cliente_id" name="cliente_id" placeholder="Ingrese el ID del Cliente">
                </div>
                <button type="submit" class="btn btn-primary" id="btn-obtener-monto-cuota">Obtener Monto de Cuota</button>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div id="div-monto-cuota" class="alert alert-success" role="alert" style="display: none;"></div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#form-obtener-monto-cuota').on('submit', function(event) {
                event.preventDefault();

                var cliente_id = $('#cliente_id').val();

                $.ajax({
                    url: '{{ route('pagos.getMontoCuota') }}',
                    type: 'GET',
                    data: { cliente_id: cliente_id },
                    success: function(response) {
                        $('#div-monto-cuota').html('Monto de Cuota: ' + response.monto_cuota);
                        $('#div-monto-cuota').show();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@stop
