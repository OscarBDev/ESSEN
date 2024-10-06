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
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id('id_cuota');
            $table->integer('nro_de_meses')->nullable();
            $table->decimal('monto_cuota', 10,2);
            $table->string('estado')->default('pendiente'); //pendiente, pagado
            $table->string('tipo_de_pago'); //efectivo , qr, deposito
            $table->date('Proxima_fecha_a_pagar')->nullable();    //deve de estar en la vista una opcion que oponga la fecha del dia de manera automatica solo que un mes adelantado, pero si pagara ese mismo instante esto se debe de poner con la fecha del dia, (osea si se pone 1 mes en nro_de_meses) 
            $table->foreignId('id_venta')->constrained('ventas', 'id_venta'); //llave foranea hacia ventas
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuotas', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
