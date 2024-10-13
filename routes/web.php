<?php

use Illuminate\Support\Facades\Route;
//agregamos controladorees
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\HistorialpreciosController;
use App\Http\Controllers\ComprasController;

Route::get('/', function () {
    return redirect()->route('login'); #redireccionamos al login directamente
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//spatie rutas

//rutas de roles
Route::group(['middleware' => ['role_or_permission:ver-rol']], function () {
    Route::resource('roles', RolController::class)
        ->only(['index']);
});
Route::group(['middleware' => ['role_or_permission:crear-rol']], function () {
    Route::resource('roles', RolController::class)
        ->only(['create', 'store']);
});
Route::group(['middleware' => ['role_or_permission:editar-rol']], function () {
    Route::resource('roles', RolController::class)
        ->only(['edit', 'update']);
});
Route::group(['middleware' => ['role_or_permission:borrar-rol']], function () {
    Route::resource('roles', RolController::class)
        ->only(['destroy']);
});

//rutas de usuarios
Route::group(['middleware' => ['role_or_permission:ver-usuario']], function () {
    Route::resource('usuarios', UsuarioController::class)
        ->only(['index']);
});
Route::group(['middleware' => ['role_or_permission:crear-usuario']], function () {
    Route::resource('usuarios', UsuarioController::class)
        ->only(['create', 'store']);
});
Route::group(['middleware' => ['role_or_permission:editar-usuario']], function () {
    Route::resource('usuarios', UsuarioController::class)
        ->only(['edit', 'update']);
});
Route::group(['middleware' => ['role_or_permission:borrar-usuario']], function () {
    Route::resource('usuarios', UsuarioController::class)
        ->only(['destroy']);
});


//rutas de todas las tablas/entidades
Route::group(['middleware' => ['role_or_permission:ver']], function () {
    Route::resource('categorias', CategoriasController::class)
        ->only(['index']);
    Route::resource('productos', ProductosController::class)
        ->only(['index']);
    Route::resource('compras', ComprasController::class)
        ->only(['index']);
    Route::get('historial_precios/{id_producto}', [HistorialpreciosController::class, 'index'])
        ->name('historial_precios.index');
});
Route::group(['middleware' => ['role_or_permission:crear']], function () {
    Route::resource('categorias', CategoriasController::class)
        ->only(['create', 'store']);
    Route::resource('productos', ProductosController::class)
        ->only(['create', 'store']);
    Route::resource('compras', ComprasController::class)
        ->only(['create', 'store']);
});
Route::group(['middleware' => ['role_or_permission:editar']], function () {
    Route::resource('categorias', CategoriasController::class)
        ->only(['edit', 'update']);
    Route::resource('productos', ProductosController::class)
        ->only(['edit', 'update']);
    Route::resource('compras', ComprasController::class)
        ->only(['edit', 'update']);
});
Route::group(['middleware' => ['role_or_permission:borrar']], function () {
    Route::resource('categorias', CategoriasController::class)
        ->only(['destroy']);
    Route::resource('productos', ProductosController::class)
        ->only(['destroy']);
    Route::resource('compras', ComprasController::class)
        ->only(['destroy']);
});
