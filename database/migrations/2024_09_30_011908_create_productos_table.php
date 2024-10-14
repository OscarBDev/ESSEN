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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('codigo',15);
            $table->string('nombre',30);
            $table->string('color',15)->nullable();
            $table->integer('comensales')->nullable();
            $table->string('capacidad',5)->nullable();
            $table->string('medida',8)->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('precio_unitario',10,2)->default(0.00);
            $table->foreignId('id_categoria')->constrained('categorias', 'id_categoria'); //llave foranea hacia categoria
            $table->timestamps();
            $table->softDeletes(); // Elimina la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos', function(Blueprint $table){
            $table->dropSoftDeletes();  // Vuelve a agregar la columna deleted_at
        });
    }
};
