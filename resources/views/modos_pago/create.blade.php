
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <center>
        <h1 style="text-align: center;font-weight: bold; color: black;">REGISTRAR MODO DE PAGO</h1>
    </center>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Agregar Modo de Pago</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('modos_pago.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="modalidad_pago" class="col-md-4 col-form-label text-md-right">Modalidad de Pago</label>

                                <div class="col-md-6">
                                    <input id="modalidad_pago" type="text" class="form-control @error('modalidad_pago') is-invalid @enderror" name="modalidad_pago" value="{{ old('modalidad_pago') }}" required autocomplete="modalidad_pago" autofocus>

                                    @error('modalidad_pago')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Agregar
                                    </button>
                                </div>
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
    <script> console.log('Hi!'); </script>
@stop
