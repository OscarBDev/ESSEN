<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallecompra extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_detalle_compra';

    //ponemos los campos de la tabla
    protected $fillable = [
        'cantidad',
        'total_compra',
        'id_producto',
        'id_compra',
    ];

    //relacion compras (1) a detallecompras (N)
    public function compras(){
        return $this->belongsTo(Compra::class, 'id_compra', 'id_compra');
    }
    //relacion productos (1) a detallecompras (N)
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
