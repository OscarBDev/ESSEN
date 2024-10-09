<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    //ponemos la id del migracion
    protected $primaryKey = 'id_empleado';

    //ponemos los campos de la tabla
    protected $fillable = [
        //hereda de la tabla persona los demas datos
        'id', 
        'id_persona'
    ];

    //relacion personas (1) a empleados (N)
    public function personas(){
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }
    //relacion user (1) a empleados (1)
    public function users(){
        return $this->belongsTo(User::class, 'id', 'id');
    }
    //relacion empleados (1) a compras (N)
    public function compras(){
        return $this->hasMany(Compra::class, 'id_empleado', 'id_empleado');
    }
    //relacion empleados (1) a ventas (N)
    public function ventas(){
        return $this->hasMany(Venta::class, 'id_empleado', 'id_empleado');
    }
    //relacion empleados (1) a prestamos (N)
    public function prestamos(){
        return $this->hasMany(Prestamo::class, 'id_empleado', 'id_empleado');
    }
}
