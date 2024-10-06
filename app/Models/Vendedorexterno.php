<?php

namespace App\Models;

use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedorexterno extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_vendedor_externo';

    //ponemos los campos de la tabla
    //hereda de la tabla persona

    //relacion personas (1) a vendedorexternos (N)
    public function personas(){
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }
    //relacion vendorexternos (1) a prestamos (N)
    public function prestamos(){
        return $this->hasMany(Prestamo::class, 'id_vendedor_externo', 'id_vendedor_externo');
    }
}
