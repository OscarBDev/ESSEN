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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id('id_prestamo');
            $table->date('fecha_prestamo');  //poner la fecha de dia deveria se pondra en la vista
            $table->foreignId('id_empleado')->constrained('empleados', 'id_empleado'); //llave foranea hacia empleados
            $table->foreignId('id_vendedor_externo')->constrained('vendorexternos', 'id_vendedor_externo'); //llave foranea hacia vendedorexternos
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
