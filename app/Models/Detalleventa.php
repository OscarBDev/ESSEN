<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleventa extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_detalle_venta';

    //ponemos los campos de la tabla
    protected $fillable = [
        'cantidad',
        'id_producto',
        'id_venta',
    ];

    //relacion productos (1) a detalleventas (N)
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
    //relacion ventas (1) a detalleventas (N)
    public function ventas(){
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }
}
