@extends('adminlte::page')

@section('title', 'Crear Rol')

@section('content_header')
<h1>Crear Rol</h1>
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
<form method="POST" action="{{ route('roles.store') }} " class="mx-auto px-4">
    @csrf
    <div class="mb-3">
        <label for="name">Nombre de Rol:</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <div class="form-group">
            <label class="form-label" for="name">Permisos para este Rol: </label>
            <br />
            @foreach ($permission as $value)
            <label class="form-check-label ml-5" style="font-weight: bold;">
                <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name form-check-input">
                {{ $value->name }}
            </label>
            <br />
            @endforeach
        </div>
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