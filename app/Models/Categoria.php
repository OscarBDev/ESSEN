<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_categoria';// si no ponemos esta linea, entonces buscara el campo id pero nosotros lo cambiamos a id_categoria
    protected $fillable = ['nombre'];

    //relacion categorias (1) a productos (N)
    public function productos(){
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }
}
