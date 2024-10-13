<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductosController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with([
            'categorias',
        ])->get();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //traemos todas las categorias
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'color' => 'nullable',
            'comensales' => 'nullable',
            'medida' => 'nullable',
            'stock' => 'required',
            'precio_unitario' => 'required',
            'id_categoria' => 'nullable|exists:categorias,id_categoria', //validamos que exista la categoria
            'nueva_categoria' => 'nullable|string',
        ]);
        //si hay un nuevo nombre de categoria, lo guardamos
        $id_categoria = $request->id_categoria;

        if (!$id_categoria && $request->nueva_categoria) {
            $categoria = Categoria::create([
                'nombre' => $request->nueva_categoria
            ]);
            $id_categoria = $categoria->id_categoria;
        }

        //creamos despues el producto con la nueva o ya existente categoria 
        Producto::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'color' => $request->color,
            'comensales' => $request->comensales,
            'medida' => $request->medida,
            'stock' => $request->stock,
            'precio_unitario' => $request->precio_unitario,
            'id_categoria' => $id_categoria
        ]);
        //redireccionamos
        return redirect()->route('productos.index');
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
    public function edit(Producto $producto)
    {
        //traemos los datos con el id de manera automatica
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //validamos
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'color' => 'nullable',
            'comensales' => 'nullable',
            'medida' => 'nullable',
            'stock' => 'required',
            'precio_unitario' => 'required',
            'id_categoria' => 'nullable|exists:categorias,id_categoria', //validamos que exista la categoria
            'nueva_categoria' => 'nullable|string',
        ]);
        $validatedData = $request->all();
        //si hay un nuevo nombre de categoria, lo guardamos
        if ($request->id_categoria === 'nuevo' && $validatedData['nueva_categoria']) {

            $nuevaCategoria = Categoria::create([
                'nombre' => $validatedData['nueva_categoria'],
            ]);
            //le agragamos lo que se creo, lanueva categoria si es el caso
            $validatedData['id_categoria'] = $nuevaCategoria->id_categoria;
        }

        //actualizamos
        $producto->update($validatedData);

        //redirecionamos
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Schema::dropIfExists('productos', function (Blueprint $table) {
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
}
