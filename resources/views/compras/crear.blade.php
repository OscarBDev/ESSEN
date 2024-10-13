@extends('adminlte::page')

@section('title', 'Registro de compras')

@section('content_header')
<h1>Registro de compras</h1>
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
<form action="{{ route('compras.store') }}" method="POST">
    @csrf

    <!-- cargamos el livewire con los campos del formulario -->
    @livewire('compra-form')
    <!-- fin del livewire con el formulario -->

</form>
<!-- fin del formulario -->

@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<!-- para hallar el precio unitario -->
<script src="{{ asset('js/PrecioUnitario.js') }}"></script>
<!-- fin de hallar el precio unitario -->
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop