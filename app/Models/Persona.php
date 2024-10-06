<?php

namespace App\Models;

use GuzzleHttp\Client;
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
        'telefono_1',
        'telefono_2',
    ];

    //relacion personas (1) a clientes (N)
    public function clientes(){
        return $this->hasMany(Cliente::class, 'id_persona', 'id_persona');
    }
    //relacion personas (1) a empleados (N)
    public function empleados(){
        return $this->hasMany(Empleado::class, 'id_persona', 'id_persona');
    }
    //relacion personas (1) a vendedorexternos (N)
    public function vendorexternos(){
        return $this->hasMany(Vendedorexterno::class, 'id_persona', 'id_persona');
    }
}
