<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarantias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garantias', function (Blueprint $table) {
            $table->id();
            $table->string('garantia');
            $table->string('Valor_Prenda');
            $table->string('Detalle_Prenda');

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('id_prestamo');
            $table->foreign('id_prestamo')->references('id')->on('prestamo')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('garantias', function (Blueprint $table) {            
            $table->dropForeign('id_cliente');
            $table->dropIndex('id_cliente');
            $table->dropColumn('id_cliente');          
            $table->dropForeign('id_prestamo');
            $table->dropIndex('id_prestamo');
            $table->dropColumn('id_prestamo');
     
        });

    }
}
