

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">REGISTRAR NUEVO INTERES %</h1>
</center>
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Agregar Interés</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('interests.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="interes_prestamo" class="col-md-4 col-form-label text-md-right">Interés del préstamo %</label>

                                <div class="col-md-6">
                                    <input id="interes_prestamo" type="number" class="form-control @error('interes_prestamo') is-invalid @enderror" name="interes_prestamo" value="{{ old('interes_prestamo') }}" required autocomplete="interes_prestamo" autofocus>

                                    @error('interes_prestamo')
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
<script> console.log('Hi!'); </script> -->
@stop
