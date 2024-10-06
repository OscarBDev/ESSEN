<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    //ponemos la id del migracion
    protected $primaryKey = 'id_devolucion';

    //ponemos los campos de la tabla
    protected $fillable = [
        'fecha_devolucion',
        'estado',
    ];

    //relacion prestamos (1) a devolucions (N)
    public function prestamos(){
        return $this->belongsTo(Prestamo::class, 'id_prestamo', 'id_prestamo');
    }
    //relacion devolucions (1) a detalledevolucions (N)
    public function detalledevolucions(){
        return $this->hasMany(Detalledevolucion::class, 'id_devolucion', 'id_devolucion');
    }
}
