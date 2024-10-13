@extends('adminlte::page')

@section('title', 'Crear Categoria')

@section('content_header')
<h1 class="title mt-4">Crear Categoria</h1>
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
<form method="POST" action="{{ route('categorias.store') }} " class="mx-auto px-4">
    @csrf
    <div class="mb-3">
        <label for="name">Nombre de Categoria:</label>
        <input type="text" name="nombre" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
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