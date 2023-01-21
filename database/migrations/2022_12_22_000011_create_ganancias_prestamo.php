<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGananciasPrestamo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganancias_prestamo', function (Blueprint $table) {
            $table->id();
            $table->double('monto', 10, 2)->nullable();
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
        Schema::dropIfExists('ganancias_prestamo', function (Blueprint $table) {            
            $table->dropForeign('id_cliente');
            $table->dropIndex('id_cliente');
            $table->dropColumn('id_cliente');          
            $table->dropForeign('id_prestamo');
            $table->dropIndex('id_prestamo');
            $table->dropColumn('id_prestamo');
     
        });

    }
}
