@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
<h1 class="title mt-4">Productos</h1>
@stop

@section('content')

<!-- tabla de compras -->
<div class="container-fluid">
    <div class="row">
        <table class="table mt-2">
            <thead class="table-dark">
                <th class="" style="display:none;">ID</th>
                <th class="">Nombre de Producto</th>
                <th class="">Codigo</th>
                <th class="">Color</th>
                <th class="">Comensales</th>
                <th class="">Capacidad</th>
                <th class="">Medida</th>
                <th class="">Stock</th>
                <th class="">Precio Unitario</th>

                <th class="">Categoria</th>
                <th class="">Acciones</th>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <!-- PRODUCTOS/CATEGORIAS DATOS -->
                    <td style="display:none;">{{ $producto->id_producto }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->color }}</td>
                    <td>{{ $producto->comensales }}</td>
                    <td>{{ $producto->capacidad }}</td>
                    <td>{{ $producto->medida }}</td>
                    <td>{{ $producto->stock }}</td>
                    <th>{{ $producto->precio_unitario }} Bs</th>
                    <!-- FIN DE PRODUCT0S -->

                    <!-- CATEGORIA DE PRODUCTO -->
                    <td>{{ $producto->categorias->nombre }}</td>
                    <!-- FIN DE CATEGORIA DE PRODUCTO -->

                    <!-- celda para los botones -->
                    <td>
                        @can('editar')
                        <a class="btn btn-info" href="{{ route('productos.edit', $producto->id_producto) }}">Editar</a>
                        @endcan

                        @can('ver')
                        <a class="btn btn-dark" href="{{ route('historial_precios.index', $producto->id_producto) }}">Historial</a>
                        @endcan
                    </td>
                    <!-- FIN -->

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- fin de tabla de compras -->

<!-- añdimos la paginacion -->
{{ $productos->links('pagination::bootstrap-4') }}

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
@stop