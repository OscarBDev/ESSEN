@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1>Usuarios</h1>
@stop

@section('content')

<!-- tabla de los usuarios -->
<p>Panel de Usuarios</p>

<!-- boton para agreagar un nuevo usuario -->
<a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>
<!-- tabla de los usuarios -->
<div class="cotainer">
    <div class="row">
        <table class="table mt-2">
            <thead class="table-dark">
                <th class="" style="display:none;">ID</th>
                <th class="">Nombre</th>
                <th class="">E-email</th>
                <th class="">Rol</th>
                <th class="">Acciones</th>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td style="display:none;">{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <!-- para los roles -->
                    <td>
                        <!-- mostramos los roles con getRoleNames segun documentacion de spatie -->
                        @if (!empty($usuario->getRoleNames()))
                        @foreach ($usuario->getRoleNames() as $rolName)
                        <h5><span class="badge badge-dark">{{ $rolName }}</span></h5>
                        @endforeach
                        @endif
                    </td>
                    <!-- celda para los botones -->
                    <td>
                        <a class="btn btn-info" href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>

                        {!! html()->form('DELETE', route('usuarios.destroy', $usuario->id))
                        ->style('display: inline')
                        ->open() !!}

                        {!! html()->button('Borrar')
                        ->type('submit')
                        ->class('btn btn-danger') !!}

                        {!! html()->form()->close() !!}
                    </td>
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
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop