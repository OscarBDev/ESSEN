@extends('adminlte::page')

@section('title', 'Historial Precios')

@section('content_header')
<h1 class="title mt-4">Historial de precios de {{ $producto->nombre }}</h1>
<a class="btn btn-info mt-4" href="{{ route('productos.index') }}">Regresar</a>
@stop

@section('content')

<!-- tabla de compras -->
<div class="container-fluid">
    <div class="row">
        <table class="table mt-2">
            <thead class="table-dark">
                <th class="" style="display:none;">ID</th>
                <th class="">Fecha</th>
                <th class="">Precio Unitario</th>
                <th class="">Cantidad</th>
                <th class="">Total Precios</th>

                <th class="">Acciones</th>
            </thead>
            <tbody>
                @foreach ($historialprecios as $historialprecio)
                <tr>
                    <!-- PRODUCTOS/CATEGORIAS DATOS -->
                    <td style="display:none;">{{ $historialprecio->id_historial_precio }}</td>
                    <td>{{ $historialprecio->fecha_historial }}</td>
                    <td>{{ $historialprecio->precio_unitario }}</td>
                    <td>{{ $historialprecio->cantidad }}</td>
                    <td>{{ $historialprecio->total_precio }}</td>
                    
                    <!-- celda para los botones -->
                    <td>
                        @can('editar')
                        <a class="btn btn-info" href="{{ route('compras.edit', $historialprecio->id_historial_precio) }}">Editar</a>
                        @endcan

                        @can('borrar-usuario')

                        {!! html()->form('DELETE', route('compras.destroy', $historialprecio->id_historial_precio))
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

<!-- añdimos la paginacion -->
{{ $historialprecios->links('pagination::bootstrap-4') }}

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