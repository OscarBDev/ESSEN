<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//agregamos
use App\Models\Compra;
use App\Models\Detallecompra;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Detallepago;
use App\Models\Empleado;
use App\Models\Historialprecio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;  //para acceder al usuario logueado

class DetallecomprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
