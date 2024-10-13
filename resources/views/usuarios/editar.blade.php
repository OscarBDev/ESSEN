@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
<h1 class="title mt-4">Editar Usuario</h1>
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
<form method="POST" action="{{ route('usuarios.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- CAMPOS DE USUARIO -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="¿Nueva contraseña?">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="confirm-password">Confirmar password</label>
                <input type="password" name="confirm-password" class="form-control" placeholder="¿Nueva contraseña?">
            </div>
        </div>
        <!-- FIN CAMPOS DE USUARIO -->
        <!-- ROLES -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="roles">Roles</label>
                <select name="roles[]" class="form-control">
                    @foreach($roles as $role)
                    <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- FIN ROLES -->
        <!-- CAMPOS DE PERSONA/EMPLEADO -->
        <div class="col-md-12">
            <h4>Información de Persona/Empleado</h4>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="ci">C.I.</label>
                <input type="text" name="ci" class="form-control" value="{{ $user->empleados->personas->ci }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $user->empleados->personas->nombre }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" value="{{ $user->empleados->personas->apellido_paterno }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" value="{{ $user->empleados->personas->apellido_materno }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="telefono_1">Teléfono 1</label>
                <input type="text" name="telefono_1" class="form-control" value="{{ $user->empleados->personas->telefono_1 }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="telefono_2">Teléfono 2</label>
                <input type="text" name="telefono_2" class="form-control" value="{{ $user->empleados->personas->telefono_2 }}">
            </div>
        </div>
        <!-- FIN CAMPOS DE PERSONA/EMPLEADO -->
        <!-- BOTON DE ENVIAR -->
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <!-- FIN BOTON DE ENVIAR -->
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
@stop