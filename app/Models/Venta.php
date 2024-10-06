<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_venta';

    //ponemos los campos de la tabla
    protected $fillable = [
        'descuento',
        'total_venta',
        'fecha_venta',
    ];

    //relacion empleados (1) a ventas (N)
    public function empleados(){
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
    //relacion clientes (1) a ventas (N)
    public function clientes(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
    //relacion ventas (1) a detalleventas (N)
    public function detalleventas(){
        return $this->hasMany(Detalleventa::class, 'id_venta', 'id_venta');
    }
    //relacion ventas (1) a cuotas (N)
    public function cuotas(){
        return $this->hasMany(Cuota::class, 'id_venta', 'id_venta');
    }
}
