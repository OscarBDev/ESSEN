@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
<h1 class="title mt-4">Crear Usuario</h1>
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
<form action="{{ route('usuarios.store') }}" method="POST">
    <!-- token de seguridad -->
    @csrf
    <!-- campos de usuario -->
    <div class="row">

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="Correo Electrónico">
            </div>
        </div>

        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Contraseña">
            </div>
        </div>

        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="confirm-password">Confirmar Password</label>
                <input type="password" name="confirm-password" class="form-control" placeholder="Confirmar Contraseña">
            </div>
        </div>

        <!-- para el rol -->
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="">Roles</label>
                {{ html()->select('roles[]', $roles)->class('form-control') }}
            </div>
        </div>
        <!-- fin de los datos de usuario -->

        <!-- Datos de la Persona -->
        <div class="col-md-12 mt-2 mb-2">
            <h4>Datos de la Persona/Empleado</h4>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="ci">Cédula de Identidad</label>
                <input type="text" name="ci" class="form-control" placeholder="Cédula de Identidad">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombres</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombres">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" placeholder="Apellido Paterno">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" placeholder="Apellido Materno">
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefono_1">Teléfono 1</label>
                        <input type="text" name="telefono_1" class="form-control" placeholder="Teléfono 1">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefono_2">Teléfono 2</label>
                        <input type="text" name="telefono_2" class="form-control" placeholder="Teléfono 2">
                    </div>
                </div>
            </div>
        </div>
        <!-- fin de los datos de persona -->

        <!-- boton para enviar el formulario de crecion -->
        <div class="colxs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
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
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop