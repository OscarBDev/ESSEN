<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//spatie
use Spatie\Permission\Models\Permission;

class SeederTablePermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ponemos los permisos
        $permisos = [
            //tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            //tabla de usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
            //todas las tablas
            'ver',
            'crear',
            'editar',
            'borrar',
        ];
        //ingresamos estos datos a la tabla permisos 
        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
