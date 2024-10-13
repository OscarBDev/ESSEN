<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//agregamos
use App\Models\Historialprecio;
use App\Models\Producto;

class HistorialpreciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_producto)
    {
        //mostramos el historial precios de un producto especifico por el id_producto
        //obtenemos el id enviado desde la vista de productos.index
        $historialprecios = Historialprecio::where('id_producto', $id_producto)->paginate(8);

        // Obtener el producto para mostrar su nombre
        $producto = Producto::find($id_producto);

        //mostramos en l vista el historial de precios
        return view('historial_precios.index', compact('historialprecios', 'producto'));
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
