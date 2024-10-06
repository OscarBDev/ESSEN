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
        //esta tabla se utulizara si es que el pago se hara con algun detalle como el de qr y los vauchers o imagnes etc

        //se esta pensando en subir de manera directa el pdf o imagen del vaucher de manera mas directa
        Schema::create('detallepagos', function (Blueprint $table) {
            $table->id('id_detalle_pago');
            $table->string('nro_de_cuenta');
            $table->decimal('deposito',10,2);   //cuanto de dinero esta dejando segunn el vaucher
            $table->date('fecha_de_deposito'); //debe de estar en la vista una opcion que ponga la fecha del dia de manera automatica 
            $table->foreignId('id_cuota')->constrained('cuotas', 'id_cuota'); //llave foranea hacia cuotas
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallepagos', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
