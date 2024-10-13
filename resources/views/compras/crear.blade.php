@extends('adminlte::page')

@section('title', 'Registro de compras')

@section('content_header')
<h1 class="title mt-4">Registro de compras</h1>
@stop

@section('content')

<!-- revissamo los errores con $errors segun documentacion de laravel 11 -->
@if ($errors->any())
<div class="alert alert-dark alert-dismissible fade show" role="alert">
    <strong>¡Revisa los campos!</strong>
    <!-- aqui mostramos los errores encontrados por $errors -->
    @foreach ($errors->all() as $error)
    <span class="badge badge-danger">{{ $error }}</span>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- fin de las alertas -->

<!-- creamos el formulario -->
<form action="{{ route('compras.store') }}" method="POST">
    @csrf

    <div class="row">
        <!-- campos de detalle compras -->
        <div class="col-md-12 mt-2 mb-2">
            <h4>Datos de Detalle Compra</h4>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="0" step="1" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="total_compra" class="form-label">Total compra</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Bs</span>
                    <input type="number" name="total_compra" id="total_compra" class="form-control" step="0.01" min="0" required>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="margen_de_ganancia" class="form-label">Margen de Ganancia</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">%</span>
                    <input type="number" name="margen_de_ganancia" id="margen_de_ganancia" class="form-control" step="0.01" min="0">
                </div>
            </div>
        </div>

        <!-- fin de los campos de detalle compras -->

        <!-- cargamos el livewire con los campos del formulario -->
        <div class="container-fluid">
            @livewire('compra-form')
        </div>
        <!-- fin del livewire con el formulario -->

        <!-- campos de producto -->
        <div class="col-md-3">
            <div class="form-group">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" required readonly>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Bs</span>
                    <input type="number" name="precio_unitario" id="precio_unitario" class="form-control" required readonly>
                </div>
            </div>
        </div>
        <!-- fin de los campos de producto -->

        <!-- Campo para nueva categoría -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="nueva_categoria" class="form-label">Agregar Nueva Categoría</label>
                <input type="text" name="nueva_categoria" id="nueva_categoria" class="form-control" placeholder="Nombre de nueva categoría">
            </div>
        </div>

        <!-- Botón de enviar -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Registrar Producto</button>
        </div>
        <!-- fin del boton -->
    </div>

</form>
<!-- fin del formulario -->

@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
<link rel="stylesheet" href="{{ asset('css/title.css') }}">
@stop

@section('js')
<!-- para hallar el precio unitario -->
<script src="{{ asset('js/PrecioUnitario.js') }}"></script>
<!-- fin de hallar el precio unitario -->
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop