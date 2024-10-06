<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    //ponemos la id del migracion
    protected $primaryKey = 'id_persona';

    //ponemos los campos de la tabla
    protected $fillable = [
        'ci',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
    ];

    //relacion Persona (1) a empleados (N)
    public function empleados(){
        return $this->hasMany(Empleado::class, 'id_categoria', 'id_categoria');
    }
}
