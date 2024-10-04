<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use App\Models\Categoria;
class CategoriasController extends Controller
{
    // public static function middleware(): array
    // {
    //     return [
    //         'permission:ver|crear|editar|borrar' => ['only' => ['index']],
    //         'permission:ver' => ['only' => ['index']],
    //         'permission:crear' => ['only' => ['create', 'store']],
    //         'permission:editar' => ['only' => ['edit', 'update']],
    //         'permission:borrar' => ['only' => ['destroy']],
    //     ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //cuando precionemos en guardar
        $request->validate([
            'nombre'=>'required|string'
        ]);
        Categoria::create($request->all());
        return redirect()->route('categorias.index');
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
    public function edit(Categoria $categoria)
    {
        return view('categorias.editar', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre'=>'required'
        ]);
        $categoria->update($request->all());
        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index');
    }
}
