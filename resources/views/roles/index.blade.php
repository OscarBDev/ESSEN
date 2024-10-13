@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
<h1 class="title mt-4">Roles</h1>
@stop

@section('content')

<!-- solo los que tienen permisos pueden ver lo que ponemos aqui -->
@can('crear-rol')
<a href="{{ route('roles.create') }}" class="btn btn-warning">Nuevo</a>
@endcan
<!-- fin del rol crear -->

<!-- tabla de los roles -->
<div class="container-fluid">
    <div class="row">
        <table class="table mt-2">
            <thead class="table-dark">
                <th class="">Rol</th>
                <th class="">Acciones</th>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <!-- para los roles -->
                    <td>
                        <!-- celda para el boton de editar -->
                        @can('editar-rol')
                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                        @endcan
                        <!-- fin de la celda para el boton de editar -->

                        <!-- boton para borrar -->
                        @can('borrar-rol')

                        {!! html()->form('DELETE', route('roles.destroy', $role->id))
                        ->style('display: inline')
                        ->open() !!}

                        {!! html()->button('Borrar')
                        ->type('submit')
                        ->class('btn btn-danger') !!}

                        {!! html()->form()->close() !!}

                        @endcan
                        <!-- fin del boton para borrar -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- ponemos la paginacion -->
        <div class="pagination justify-content-end">
            {!! $roles->links() !!}
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