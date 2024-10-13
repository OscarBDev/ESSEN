@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1 class="title mt-4">Empleados</h1>
@stop

@section('content')

<!-- boton para agreagar un nuevo usuario -->
@can('crear-usuario')
<a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo Empleado</a>
@endcan
<!-- tabla de los usuarios -->
<div class="cotainer">
    <div class="row">
        <table class="table mt-2">
            <thead class="table-dark">
                <th class="" style="display:none;">ID</th>
                <th class="">E-email</th>
                <th class="">CI</th>
                <th class="">Nombre</th>
                <th class="">Apellido Paterno</th>
                <th class="">Apellido Materno</th>
                <th class="">Telefono 1</th>
                <th class="">Telefono 2</th>
                <th class="">Rol</th>
                <th class="">Acciones</th>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td style="display:none;">{{ $usuario->id }}</td>
                    <!-- USUARIOS DATOS -->
                    <td>{{ $usuario->email }}</td>
                    <!-- FIN -->
                    <!-- PERSONAS / EMPLADOS DATOS -->
                    @if ($usuario->empleados && $usuario->empleados->personas)
                    <td>{{ $usuario->empleados->personas->ci }}</td>
                    <td>{{ $usuario->empleados->personas->nombre }} </td>
                    <td>{{ $usuario->empleados->personas->apellido_paterno }}</td>
                    <td>{{ $usuario->empleados->personas->apellido_materno }}</td>
                    <td>{{ $usuario->empleados->personas->telefono_1 }}</td>
                    <td>{{ $usuario->empleados->personas->telefono_2 }}</td>
                    @else
                    <td colspan="6">No hay información de la persona disponible</td>
                    @endif
                    <!-- FIN -->
                    <!-- ROLES -->
                    <td>
                        <!-- mostramos los roles con getRoleNames segun documentacion de spatie -->
                        @if (!empty($usuario->getRoleNames()))
                        @foreach ($usuario->getRoleNames() as $rolName)
                        <h5><span class="badge badge-dark">{{ $rolName }}</span></h5>
                        @endforeach
                        @endif
                    </td>
                    <!-- FIN -->
                    <!-- celda para los botones -->
                    <td>
                        @can('editar-usuario')
                        <a class="btn btn-info" href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                        @endcan

                        @can('borrar-usuario')

                        {!! html()->form('DELETE', route('usuarios.destroy', $usuario->id))
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
<!-- fin de la tabla de usuarios -->
<!-- añañdimos la paginacion -->
<div class="pagination justify-content-end">
    {!! $usuarios->links() !!}
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