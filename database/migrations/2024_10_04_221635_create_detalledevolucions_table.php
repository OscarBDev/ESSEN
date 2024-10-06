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
        Schema::create('detalledevolucions', function (Blueprint $table) {
            $table->id('id_detalle_devolucion');
            $table->integer('cantidad');
            $table->string('tipo_de_devolcion');  //el mismo producto o otro producto con el mismo valor monetario
            $table->foreignId('id_devolucion')->constrained('devolucions', 'id_devolucion'); //llave foranea hacia devolucions
            $table->foreignId('id_producto')->constrained('productos', 'id_producto'); //llave foranea hacia productos
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalledevolucions', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
