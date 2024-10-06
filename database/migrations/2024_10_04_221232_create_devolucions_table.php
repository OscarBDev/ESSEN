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
        Schema::create('devolucions', function (Blueprint $table) {
            $table->id('id_devolucion');
            $table->date('fecha_devolucion'); //debe de poner la fecha del dia en la vista 
            $table->string('estado');  // devuelto - pendiente
            $table->foreignId('id_prestamo')->constrained('prestamos', 'id_prestamo'); //llave foranea hacia prestamos
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devolucions', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
