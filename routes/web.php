<?php

use Illuminate\Support\Facades\Route;
//agregamos controladorees
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;

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
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    //rutas de los controladores segun el digrama entidad relacion
    Route::resource('categorias', CategoriasController::class);
    Route::resource('productos', ProductosController::class);
});
