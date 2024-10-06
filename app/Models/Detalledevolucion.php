<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalledevolucion extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_detalle_devolucion';

    //ponemos los campos de la tabla
    protected $fillable = [
        'cantidad',
        'tipo_de_devolucion',
    ];

    //relacion productos (1) a detalledevolucions (N)
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
    //relacion devolucions (1) a detalledevolucions (N)
    public function devolucions(){
        return $this->belongsTo(Devolucion::class, 'id_devolucion', 'id_devolucion');
    }
}
