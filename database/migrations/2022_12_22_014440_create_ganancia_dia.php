<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGananciaDia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganancia_dia', function (Blueprint $table) {
            $table->id();
            $table->double('monto', 10, 2)->nullable();
            $table->datetime('fecha');
            
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('id_pago');
            $table->foreign('id_pago')->references('id')->on('pagos')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ganancia_dia', function (Blueprint $table) {                     
            $table->dropConstrainedForeignId('id_usuario');  
            $table->dropConstrainedForeignId('id_cliente');
            $table->dropConstrainedForeignId('id_pago');
        });
    }
}
