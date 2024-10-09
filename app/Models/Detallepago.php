<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallepago extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_detalle_pago';

    //ponemos los campos de la tabla
    protected $fillable = [
        'nro_de_cuenta',
        'deposito',
        'fecha_de_deposito',
        'id_cuota',
    ];

    //relacion cuotas (0) a detallepagos (N)
    public function cuotas(){
        return $this->belongsTo(Cuota::class, 'id_cuota', 'id_cuota');
    }
}
