@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
<h1>Editar Rol</h1>
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

<!-- creamos el formulario -->
<form method="PATCH" action="{{ route('roles.update', $role->id) }}">
    @csrf

    <div class="mb-3">
        <label for="name">Nombre del Rol:</label>
        <input type="text" name="name" class="form-control" value="{{ $role->name }}">
    </div>

    <div class="mb-3">
        <label for="name">Permisos de este Rol:</label>
        <br />
        @foreach ($permissions as $value)
        <label class="form-check-label ml-5" style="font-weight: bold;">
            <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name form-check-input" @checked(in_array($value->id, $rolePermissions))>
            {{ $value->name }}
        </label>
        <br />
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<!-- fin del formulario -->

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