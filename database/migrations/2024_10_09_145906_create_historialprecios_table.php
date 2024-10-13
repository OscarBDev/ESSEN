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
        Schema::create('historialprecios', function (Blueprint $table) {
            $table->id('id_historial_precio');
            $table->decimal('precio_unitario',10,2);
            $table->integer('cantidad');
            $table->decimal('total_precio',10,2);
            $table->date('fecha_historial');   //deve de estar en la vista una opcion que ponga la fecha del dia de manera automatica
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
        Schema::dropIfExists('historialprecios', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
