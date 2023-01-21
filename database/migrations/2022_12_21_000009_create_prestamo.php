<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo', function (Blueprint $table) {
            $table->id();
            $table->double('monto_prestamo', 10, 2)->nullable();
            $table->string('duracion_prestamo');
            $table->string('calculo_cuota');
            $table->string('garantia');
            $table->string('cantidad_cuotas');
            $table->string('monto_cancelado');
            $table->string('monto_prestado');
            

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_interes');
            $table->foreign('id_interes')->references('id')->on('intereses')->onDelete('cascade');
            $table->unsignedBigInteger('id_modo_pago');
            $table->foreign('id_modo_pago')->references('id')->on('modo_pago')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamo', function (Blueprint $table) {            
            $table->dropConstrainedForeignId('id_cliente');          
            $table->dropConstrainedForeignId('id_usuario');   
            $table->dropConstrainedForeignId('id_interes');
            $table->dropConstrainedForeignId('id_modo_pago');
        });

    }
}
