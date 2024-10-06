<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleprestamo extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_detalle_prestamo';

    //ponemos los campos de la tabla
    protected $fillable = [
        'cantidad',
    ];

    //relacion productos (1) a detalleprestamos (N)
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
    //relacion prestamos (1) a detalleprestamos (N)
    public function prestamos(){
        return $this->belongsTo(Prestamo::class, 'id_prestamo', 'id_prestamo');
    }
}
