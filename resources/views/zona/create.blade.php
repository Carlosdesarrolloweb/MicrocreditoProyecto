@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;font-weight: bold; color: black;">AGREGAR NUEVA ZONA</h1>
     <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
@stop

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
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
    {{-- <script>
        // Obtener elementos DOM
        const codZona = document.getElementById('cod_zona');
        const nombreZona = document.getElementById('nombre_zona');

        // Agregar listener al evento input en el campo cod_zona
        codZona.addEventListener('input', function() {
            // Hacer una petición AJAX para obtener la zona correspondiente al código
            fetch('{{ route('zonas.getByName') }}?cod_zona=' + codZona.value)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        // Si se encuentra la zona, actualizar el valor del campo nombre_zona
                        nombreZona.value = data.nombre_zona;
                    } else {
                        // Si no se encuentra la zona, borrar el valor del campo nombre_zona
                        nombreZona.value = '';
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script> --}}
@stop
