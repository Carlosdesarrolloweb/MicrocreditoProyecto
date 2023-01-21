<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_cliente', function (Blueprint $table) {
            $table->datetime('fecha_inicio_prestamo');
            $table->datetime('fecha_fin_prestamo');
            $table->string('estado_prestamo');

            $table->unsignedBigInteger('id_prestamo');
            $table->foreign('id_prestamo')->references('id')->on('prestamo')->onDelete('cascade');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_cliente', function (Blueprint $table) {                     
            $table->dropConstrainedForeignId('id_prestamo');  
            $table->dropConstrainedForeignId('id_cliente');
        });
        
    }
}
