<?php

namespace App\Models;

use Faker\Provider\ar_EG\Person;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_cliente';

    //ponemos los campos de la tabla
    protected $fillable = [
        //hereda de la tabla persona
        'direccion',
    ];
    //relacion personas (1) a clientes (N)
    public function personas(){
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }
    //relacion clientes (1) a ventas (N)
    public function ventas(){
        return $this->hasMany(Venta::class, 'id_cliente', 'id_cliente');
    }
}
