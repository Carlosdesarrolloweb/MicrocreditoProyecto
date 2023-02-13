<!-- Archivo: resources/views/loans/create.blade.php -->
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1>REGISTRAR GARANTIA</h1>
</center>
@stop

@section('content')

                <p>
                    <p>

                    </p>
                </p>

        <form method="post" action="" enctype="multipart/form-data">
            @csrf

            <div class="container">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="client">CLIENTE</label>
                        <input type="text" class="form-control" id="client" name="client">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="amount">NOMBRE GARANTIA</label>
                        <input type="text" class="form-control" id="amount" name="amount">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="amount">VALOR PRENDA "BS"</label>
                        <input type="text" class="form-control" id="amount" name="amount">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                                <label for="interest_rate">DETALLE DE LA GARANTIA</label>
                                <input type="text" class="form-control" id="interest_rate" name="interest_rate">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <x-jet-label for="id_foto" value="" />
                        <x-jet-input  id="id_foto" class="form-control" type="FILE" name="id_foto" :value="old('id_foto')" required />
                    </div>
                    <div class="form-group col-md-6">
                        <x-jet-label for="id_fotocarnet" value="" />
                        <x-jet-input  id="id_fotocarnet" class="form-control" type="FILE" name="id_fotocarnet" :value="old('id_fotocarnet')" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <x-jet-label for="id_fotorecibo" value="" />
                        <x-jet-input  id="id_fotorecibo" class="form-control" type="FILE" name="id_fotorecibo" :value="old('id_fotorecibo')" required />
                    </div>
                    <div class="form-group col-md-6">
                        <x-jet-label for="id_fotocroquis" value="" />
                        <x-jet-input  id="id_fotocroquis" class="form-control" type="FILE" name="id_fotocroquis" :value="old('id_fotocroquis')" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="payment_mode">OBSERVACIONES</label>
                                <select class="form-control" id="payment_mode" name="payment_mode">
                                <option value="daily">CUMPLE REQUISITOS</option>
                                <option value="weekly">NO CUMPLE</option>
                                </select>
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
