<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_compra';

    //ponemos los campos de la tabla
    protected $fillable = [
        'fecha_compra',
    ];

    //relacion empleados (1) a compras (N)
    public function empleados(){
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
    //relacion compras (1) a detallecompras (N)
    public function detallecompras(){
        return $this->hasMany(Detallecompra::class, 'id_compra', 'id_compra');
    }
}
