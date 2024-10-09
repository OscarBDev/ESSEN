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
        'precio_unitario',
        'id_categoria',
    ];

    //relacion categorias (1) a productos (N)
    public function categorias(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
    //relacion productos (1) a detallecompras (N)
    public function detallecompras(){
        return $this->hasMany(Detallecompra::class, 'id_producto', 'id_producto');
    }
    //relacion productos (0) a promocions (1)
    public function promocions(){
        return $this->hasOne(Promocion::class, 'id_producto', 'id_producto');
    }
    //relacion productos (1) a detalleventas (N)
    public function detalleventas(){
        return $this->hasMany(Detalleventa::class, 'id_producto', 'id_producto');
    }
    //relacion productos (1) a detalleprestamos (N)
    public function detalleprestamos(){
        return $this->hasMany(Detalleprestamo::class, 'id_producto', 'id_producto');
    }
    //relacion productos (1) a detalledevolucions (N)
    public function detalledevolucions(){
        return $this->hasMany(Detalledevolucion::class, 'id_producto', 'id_producto');
    }
}
