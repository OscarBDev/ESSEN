<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //crremos todos los seeders desde aqui
        $this->call([
            UsersTableSeeder::class,   //inserta un usuario
            SeederTablePermisos::class,  //inserta todos los roles
        ]);
    }
}
