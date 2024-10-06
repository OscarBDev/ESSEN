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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            $table->decimal('descuento',10,2);
            $table->decimal('total_venta', 10,2);
            $table->date('fecha_venta');   //deve de estar en la vista una opcion que ponga la fecha del dia de manera automatica 
            $table->foreignId('id_empleado')->constrained('empleados', 'id_empleado'); //llave foranea hacia empleados
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente'); //llave foranea hacia clientes
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
