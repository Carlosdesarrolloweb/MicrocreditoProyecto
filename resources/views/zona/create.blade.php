@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;font-weight: bold; color: black;">AGREGAR NUEVA ZONA</h1>
     <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
@stop

@section('content')
<div class="container">
    <div class="form-group col-md-8">
        <div class="col-md-12 text-right mb-3">
            <button type="button" class="btn btn-danger btn-lg" id="btnLimpiar">
                <i class="far fa-file-alt fa-lg"></i> Limpiar
            </button>
            <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                <i class="fas fa-question-circle fa-lg"></i> Ayuda
            </button>
            <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                <i class="fas fa-sign-out-alt fa-lg"></i> Salir
            </button>
        </div>
<div class="row">
    <div class="col-md-10 offset-md-2">
        <div class="custom-box" style="background-color: #75606069; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
            <div class="card-header">
                    <h5 class="card-title">Crear Zona</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('zonas.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="cod_zona">Código de Zona</label>
                            <input type="text" class="form-control" id="cod_zona" name="cod_zona" value="{{ old('cod_zona') }}" required onblur="buscarZona()">
                            <div class="invalid-feedback" id="mensaje-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="nombre_zona">Nombre de Zona</label>
                            <input type="text" class="form-control @error('nombre_zona') is-invalid @enderror" id="nombre_zona" name="nombre_zona" value="{{ old('nombre_zona') }}" required>
                            @error('nombre_zona')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success fa fa-save"> Crear</button>
                    </form>
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
    <script> console.log('Hi!'); </script> -->
    <script>
        function buscarZona() {
            var cod_zona = document.getElementById('cod_zona').value;

            if (cod_zona != '') {
                $.ajax({
                    url: '/buscar-zona/' + cod_zona,
                    type: 'GET',
                    success: function(response) {
                        if (response.nombre_zona != '') {
                            document.getElementById('nombre_zona').value = response.nombre_zona;
                        } else {
                            document.getElementById('nombre_zona').value = '';
                        }
                    },
                    error: function(xhr, status, error) {
                        document.getElementById('mensaje-error').textContent = 'Ha ocurrido un error al buscar la zona';
                    }
                });
            }
        }
    </script>
    <script>
        //BOTON DE AYUDA
    document.getElementById('btnAyuda').addEventListener('click', function() {
        Swal.fire({
            title: 'Ayuda',
            html: '<embed src="/pdf/crearpago.pdf" type="application/pdf" width="100%" height="800px" />',
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
        document.getElementById("cod_zona").value = "";
        document.getElementById("nombre_zona").value = "";
        document.getElementById("mensaje-error").innerHTML = "";
    });


</script>
<script>
    $(document).ready(function() {
        // Obtener los elementos del formulario
        var clienteSelect = $('#id_cliente');
        var idprestamo = $('#id_prestamo');
        var montoInput = $('#monto_prestamo');
        var cuotaInput = $('#cuota');
        var numeroCuotaInput = $('#Numero_Cuota');

        // Agregar un evento de cambio al selector de cliente
        clienteSelect.change(function() {
            var clienteId = $(this).val(); // Obtener el ID del cliente seleccionado
            console.log(clienteId);
            // Hacer una solicitud AJAX al servidor
            $.ajax({
                url: "{{ route('pagos.obtenerPorCliente', ':clienteId') }}".replace(':clienteId', clienteId),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    // Llenar los campos con los datos del préstamo
                    montoInput.val(response.prestamo.monto_prestamo);
                    cuotaInput.val(response.prestamo.calculo_cuota);
                    numeroCuotaInput.val(response.cuota);
                    idprestamo.val(response.prestamo.id);
                },
                error: function(response) {
                    console.log(response); // Manejar errores
                }
            });
        });

        $('#pagoForm').submit(function(e) {
            e.preventDefault(); // previene el envío del formulario

            // Mostrar alerta de confirmación antes de enviar el formulario
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Se registrará el pago del cliente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Registrar Pago!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario
                    this.submit();

                    // Mostrar mensaje de éxito después de enviar el formulario
                    Swal.fire({
                        icon: 'success',
                        title: 'Pago Registrado',
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
