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
        Schema::create('detalleprestamos', function (Blueprint $table) {
            $table->id('id_detalle_prestamo');
            $table->integer('cantidad');
            $table->foreignId('id_producto')->constrained('productos', 'id_producto'); //llave foranea hacia productos
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
        Schema::dropIfExists('detalleprestamos', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
