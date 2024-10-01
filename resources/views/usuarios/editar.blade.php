@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
<h1>Editar Usuario</h1>
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

    <div class="mb-3">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
    </div>

    <div class="mb-3">
        <label for="email">E-mail</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
    </div>

    <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" placeholder="¿Nueva contraseña?">
    </div>

    <div class="mb-3">
        <label for="confirm-password">Confirmar password</label>
        <input type="password" name="confirm-password" class="form-control" placeholder="¿Nueva contraseña?">
    </div>

    <div class="mb-3">
        <label for="roles">Roles</label>
        <select name="roles[]" class="form-control">
            @foreach($roles as $role)
            <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}>
                {{ $role }}
            </option>
            @endforeach
        </select>
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