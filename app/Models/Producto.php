<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'nombre',
        'color',
        'comensales',
        'capacidad',
        'medida',
        'stock',
        'precio_unitario'
    ];

    //relacion categorias (1) a productos (N)
    public function categorias(){
        return $this->belongsTo(Producto::class, 'id_categoria', 'id_categoria');
    }
}
