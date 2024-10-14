@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="title mt-4">Detalle de compras</h1>
@stop

@section('content')

<!-- boton para agregar una nueva compra -->
@can('ver')
<a class="btn btn-warning" href="{{ route('compras.create') }}">Nuevo compra</a>
@endcan

<!-- tabla de compras -->
<div class="container-fluid">
    <div class="row">
        <table class="table mt-2">
            <thead class="table-dark">
                <th class="" style="display:none;">ID</th>

                <th class="">Fecha compra</th>
                <th class="">Empleado</th>

                <th class="">Cantidad comprada</th>
                <th class="">Total compra</th>
                <th class="">Margen de ganancia</th>

                <th class="">Nombre de Producto</th>
                <th class="">Precio Unitario</th>

                <th class="">Categoria</th>
                <th class="">Acciones</th>
            </thead>
            <tbody>
                @foreach ($detallecompras as $detallecompra)
                <tr>
                    <!-- DATOS DE DETALLE COMPRA -->
                    <td style="display:none;">{{ $detallecompra->id_detalle_compra }}</td>
                    <!-- FIN DE DETALLE COMPRA -->

                    <!-- DETALLE COMPRAS -->
                    <td>{{ $detallecompra->compras->fecha_compra }}</td>
                    <!-- empleado que realizo la venta -->
                    <td>{{ $detallecompra->compras->empleados->personas->nombre }}</td>
                    <!-- FIN COMPRAS -->
                    
                    <!-- detalle venta -->
                    <td>{{ $detallecompra->cantidad }}</td>
                    <th>{{ $detallecompra->total_compra }} Bs</th>
                    <th>{{ $detallecompra->margen_de_ganancia }} %</th>
                    <!-- fin de detalle venta -->

                    <!-- PRODUCTOS/CATEGORIAS DATOS -->
                    <td>{{ $detallecompra->productos->nombre }}</td>
                    <th>{{ $detallecompra->productos->precio_unitario }} Bs</th>
                    <!-- FIN DE PRODUCT0S -->

                    <!-- CATEGORIA DE PRODUCTO -->
                    <td>{{ $detallecompra->productos->categorias->nombre }}</td>
                    <!-- FIN DE CATEGORIA DE PRODUCTO -->

                    <!-- celda para los botones -->
                    <td>
                        @can('editar')
                        <a class="btn btn-info" href="{{ route('compras.edit', $detallecompra->id_detalle_compra) }}">Editar</a>
                        @endcan

                        @can('borrar')

                        {!! html()->form('DELETE', route('compras.destroy', $detallecompra->id_detalle_compra))
                        ->style('display: inline')
                        ->open() !!}

                        {!! html()->button('Borrar')
                        ->type('submit')
                        ->class('btn btn-danger') !!}

                        {!! html()->form()->close() !!}

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

<!-- añañdimos la paginacion -->
{{ $detallecompras->links('pagination::bootstrap-4') }}

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