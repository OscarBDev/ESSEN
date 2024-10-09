<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_prestamo';

    //ponemos los campos de la tabla
    protected $fillable = [
        'fecha_prestamo',
        'id_empleado',
        'id_vendedor_externo',
    ];

    //relacion empleados (1) a prestamos (N)
    public function empleados(){
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
    //relacion vendorexternos (1) a prestamos (N)
    public function vendedorexternos(){
        return $this->belongsTo(Vendedorexterno::class, 'id_vendedor_externo', 'id_vendedor_externo');
    }
    //relacion prestamos (1) a detalleprestamos (N)
    public function detalleprestamos(){
        return $this->hasMany(Detalleprestamo::class, 'id_prestamo', 'id_prestamo');
    }
    //relacion prestamos (1) a devolucions (N)
    public function devolucions(){
        return $this->hasMany(Devolucion::class, 'id_prestamo', 'id_prestamo');
    }
}
