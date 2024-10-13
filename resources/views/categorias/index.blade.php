@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<h1 class="title mt-4">Categorias</h1>
@stop

@section('content')

<!-- solo los que tienen permisos pueden ver lo que ponemos aqui -->
@can('crear')
<a href="{{ route('categorias.create') }}" class="btn btn-warning">Nuevo</a>
@endcan
<!-- fin del rol crear -->

<!-- tabla de los roles -->
<div class="container-fluid">
    <div class="row">
        <table class="table mt-2">
            <thead class="table-dark">
                <th class="">Nombre de Categoria</th>
                <th class="">Acciones</th>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <!-- para los roles -->
                    <td>
                        <!-- celda para el boton de editar -->
                        @can('editar')
                        <a class="btn btn-primary" href="{{ route('categorias.edit', $categoria->id_categoria) }}">Editar</a>
                        @endcan
                        <!-- fin de la celda para el boton de editar -->

                        <!-- boton para borrar -->
                        @can('borrar')

                        <form method="DELETE" action="{{ route('categorias.destroy', $categoria->id_categoria) }}" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>

                        @endcan
                        <!-- fin del boton para borrar -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- ponemos la paginacion -->
        <div class="pagination justify-content-end">
            {!! $categorias->links() !!}
        </div>
        <!-- fin de la paginacion -->
    </div>
</div>

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