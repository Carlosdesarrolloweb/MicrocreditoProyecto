@extends('adminlte::page')

@section('title', 'Obtener Monto de Cuota')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">pago</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
</th>
@stop

@section('content')
@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
<div class="card-body">
    <form method="POST" action="{{ route('pagos.store') }}">
        @csrf

        <div class="form-group">
            <label for="cliente_id">Cliente:</label>
            <select class="form-control" id="cliente_id" name="cliente_id" required>
                <option value="">Seleccionar cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</option>
                @endforeach
            </select>
        </div>

        @if ($prestamo)
            <div class="form-group">
                <label for="prestamo_id">Préstamo:</label>
                <input type="text" class="form-control" id="prestamo_id" value="{{ $prestamo->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="monto_cuota">Monto de Cuota:</label>
                <input type="text" class="form-control" id="monto_cuota" value="{{ $cuota }}" readonly>
            </div>
        @endif

        <div class="form-group">
            <label for="monto">Monto:</label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" value="{{ old('monto') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Pago</button>
    </form>
</div>
</div>
@stop
@endsection


@section('scripts')

@endsection
@stop

@section('scripts')

@endsection
