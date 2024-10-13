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

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detallecompras = Detallecompra::with([
            'productos.categorias',
            'compras.empleados.personas',
            'compras',
            'productos'
        ])->get();
        return view('compras.index', compact('detallecompras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Obtener todas las categorias, productos, enpleados 
        $categorias = Categoria::all();
        $productos = Producto::all();
        $empleados = Empleado::all();

        //pasamos datos a la vista 
        return view('compras.crear', compact('categorias', 'productos', 'empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar los datos del formulario
        $request->validate([
            //detalle_compras
            'cantidad' => 'required|numeric',
            'total_compra' => 'required|numeric',
            'margen_de_ganancia' => 'nullable|numeric',
            //tablas productos
            'nombre' => 'required|string',
            'codigo' => 'required',
            'color' => 'nullable|string',
            'comensales' => 'nullable|numeric',
            'medida' => 'nullable|string',
            'stock' => 'required|numeric',
            'precio_unitario' => 'required|numeric',
            //tabla de categorias
            'id_categoria' => 'nullable|exists:categorias,id_categoria',  //validamos que se auna categoria existente
            'nueva_categoria' => 'nullable|string|max:100',  // validamos el campo para nueva categoria 
            // Aquí añadimos el id_producto para identificar si ya existe
            'id_producto' => 'nullable|exists:productos,id_producto',
        ]);

        //comnazamos la transaccion
        DB::transaction(function () use ($request) {

            //obtenemos el id de la persona logueada
            $user = Auth::user();
            $empleado = $user->empleados;  //obtenemos la persona asociada al usuario logueado

            //si no se encuentra el enpleado asociado al usuario
            if (!$empleado) {
                throw new \Exception('No se encontro el empleado logueado');
            }

            //COMPRAS
            //creamos la compra 
            $compra = Compra::create([
                'fecha_compra' => now(),
                'id_empleado' => $empleado->id_empleado,  //id de la tabla empleados de la persona logueada
            ]);

            //CATEGORIAS
            //si se proporciona una nueva categoria, la creamos
            if ($request->nueva_categoria) {
                $categoria = Categoria::create([
                    'nombre' => $request->nueva_categoria
                ]);
            } else {
                //si no hay una nueva categoria, se obtiene la categoria seleccionada
                $categoria = Categoria::find($request->id_categoria);
            }

            //PRODUCTOS
            //buscamos si el producto existe
            $producto = Producto::find($request->id_producto);

            if ($producto) {
                //si el producto existe, actualizamos el stock sumando la cantidad
                $producto->update([
                    'stock' => $producto->stock + $request->stock,   //sumammos la nueva cantidad al stock existente
                    'precio_unitario' => $request->precio_unitario,  //actualizamos el precio unitario
                ]);
            } else {
                //creamos el producto
                $producto = Producto::create([
                    'nombre' => $request->nombre,
                    'codigo' => $request->codigo,
                    'color' => $request->color,
                    'comensales' => $request->comensales,
                    'medida' => $request->medida,
                    'stock' => $request->stock,
                    'precio_unitario' => $request->precio_unitario,  // precio unitario calculado
                    'id_categoria' => $categoria->id_categoria,  //asiganamos la id de la categoria
                ]);
            }

            //DETALLES DE COMPRAS
            //crear el detalle de la compra
            $detallecompra = Detallecompra::create([
                'cantidad' => $request->cantidad,
                'total_compra' => $request->total_compra,
                'margen_de_ganancia' => $request->margen_de_ganancia,
                'id_producto' => $producto->id_producto,   //id de la tabla productos
                'id_compra' => $compra->id_compra,  //id de la tabla compras
            ]);

            //HISTORIAL DE PRECIOS
            // registramos el precio del producto en historial de precios 
            Historialprecio::create([
                'id_producto' => $producto->id_producto,  //id del producto
                'precio_unitario' => $request->precio_unitario,  //precio unitario del producto calculado
                'cantidad' => $detallecompra->cantidad,   //cantidad comprada en esta compra (traida desde detallecompra)
                'total_precio' => $detallecompra->total_compra,  //precio total (desde detallecompra)
                'fecha_historial' => now(),  //fecha de la trasaccion
            ]);
        });

        //redirigimos a la vista de compras
        return redirect()->route('compras.index');
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
