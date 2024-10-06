<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id('id_compra');
            $table->date('fecha_compra');   //deve de estar en la vista una opcion que oponga la fecha del dia de manera automatica 
            $table->foreignId('id_empleado')->constrained('empleados', 'id_empleado'); //llave foranea hacia empleados
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
