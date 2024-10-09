<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//agregamos
use App\Models\Persona;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // User::factory(10)->create();

            //creamos el usuario por defecto 
            $user = User::factory()->create([
                //name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
            ]);

            //creamos la persona asociada a este usuario
            $persona = Persona::create([
                'ci' => '12345678',
                'nombre' => 'Oscar Luis',
                'apellido_paterno' => 'Blanco',
                'apellido_materno' => 'Machaca',
            ]);

            //creamos el empleado asociado a este usuario
            Empleado::create([
                'id' => $user->id,  //ID del usuario
                'id_persona' => $persona->id_persona, //ID de la persona
            ]);
        });
    }
}
