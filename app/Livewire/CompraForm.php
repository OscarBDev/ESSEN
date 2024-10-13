<?php

namespace App\Livewire;

use Livewire\Component;
//agregamos
use App\Models\Compra;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Detallecompra;
use App\Models\Historialprecio;
use App\Models\Empleado;
use Illuminate\Support\Facades\Http;

class CompraForm extends Component
{
    //variables
    public $cantidad;
    public $total_compra;
    public $margen_de_ganancia;

    public $id_producto;
    public $nombre;
    public $codigo;
    public $color;
    public $comensales;
    public $medida;
    public $stock;
    public $precio_unitario;
    public $id_categoria;
    public $nueva_categoria;

    public $categoria_nombre;

    //cargamos datos
    public $categorias;
    public $productos;
    public $empleados;

    public function mount()
    {
        // Cargar las categorías, productos y empleados
        $this->categorias = Categoria::all();
        $this->productos = Producto::all();
        $this->empleados = Empleado::all();
    }

    // Actualiza los campos automáticamente cuando cambia el código del producto
    public function update()
    {
        // $producto = Producto::where('codigo', $this->codigo)
        //     ->orWhere('nombre', $this->nombre)
        //     ->first();

        $producto = Producto::where('nombre', $this->nombre)
            ->first();

        if ($producto) {
            // Si el producto existe, llenamos los campos con su información
            $this->id_producto = $producto->id_producto;
            $this->nombre = $producto->nombre;
            $this->codigo = $producto->codigo;
            $this->color = $producto->color;
            $this->comensales = $producto->comensales;
            $this->medida = $producto->medida;
            // Asigna la categoría del producto
            $this->categoria_nombre = $producto->categoria->nombre ?? ''; // método que se esta usando para acceder a la categoría
            $this->id_categoria = $producto->id_categoria; // Asegúrate de que esto sea el ID de la categoría
        } else {
            // Si no existe, vaciamos los campos
            $this->reset(['color', 'comensales', 'medida', 'stock', 'precio_unitario', 'categoria_nombre']);
        }
    }




    //mandamos a la vista de livewire
    public function render()
    {
        return view('livewire.compra-form');
    }
}
