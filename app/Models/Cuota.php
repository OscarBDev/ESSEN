<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_promocion';

    //ponemos los campos de la tabla
    protected $fillable = [
        'nro_de_meses',
        'monto_cuota',
        'estado',
        'tipo_de_pago',
        'Proxima_fecha_a_pagar',
        'id_venta'
    ];

    //relacion ventas (1) a cuotas (N)
    public function ventas(){
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }
    //relacion cuotas (0) a detallepagos (N)
    public function detallepagos(){
        return $this->hasMany(Detallepago::class, 'id_cuota', 'id_cuota');
    }
}
