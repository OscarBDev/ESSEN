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
        Schema::create('detallecompras', function (Blueprint $table) {
            $table->id('id_detalle_compra');
            $table->integer('cantidad');
            $table->decimal('total_compra',10,2);
            $table->foreignId('id_producto')->constrained('productos', 'id_producto'); //llave foranea hacia productos
            $table->foreignId('id_compra')->constrained('compras', 'id_compra'); //llave foranea hacia compras
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallecompras', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
