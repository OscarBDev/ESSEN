@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
<h1 class="title mt-4">Editar Producto: {{ $producto->nombre }}</h1>
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

<!-- creamso el formulario -->
<form method="POST" action="{{ route('productos.update', $producto->id_producto) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- CAMPOS DE PRODUCTOS-->
        <div class="col-md-6">
            <div class="form-group">
                <label for="text">Nombre de Producto</label>
                <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="text">Codigo</label>
                <input type="text" name="codigo" class="form-control" value="{{ $producto->codigo }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="text">Color</label>
                <input type="text" name="color" class="form-control" value="{{ $producto->color }}" pattern="[A-Za-z]+" title="Solo se permiten letras">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="text">Comensales</label>
                <input type="number" name="comensales" class="form-control" value="{{ $producto->comensales }}" min="0" step="1">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="text">Capacidad</label>
                <input type="text" name="capacidad" class="form-control" value="{{ $producto->capacidad }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="text">Medida</label>
                <input type="text" name="medida" class="form-control" value="{{ $producto->medida }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="text">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" readonly>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="text">Precio Unitario</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Bs</span>
                    <input type="number" name="precio_unitario" class="form-control" value="{{ $producto->precio_unitario }}" step="0.01" min="0" readonly>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="id_categoria">Categoría</label>
                <select name="id_categoria" id="id_categoria" class="form-control">
                    <option value="">Seleccionar categoría</option>
                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}" {{ (old('id_categoria', $producto->id_categoria) == $categoria->id_categoria) ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                    @endforeach
                    <option value="nuevo">Crear nueva categoría</option>
                </select>
                @error('id_categoria')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group" id="nueva_categoria_div" style="display: none;">
            <label for="nueva_categoria">Nueva Categoría</label>
            <input type="text" name="nueva_categoria" id="nueva_categoria" class="form-control" value="{{ old('nueva_categoria') }}">
            @error('nueva_categoria')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botón de enviar/cancelar -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
        <!-- fin del boton -->

        <!-- FIN DE CAMPOS DE PRODUCTOS -->
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
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>

<script src="{{ asset('js/NuevaCategoria.js') }}"></script>

@stop