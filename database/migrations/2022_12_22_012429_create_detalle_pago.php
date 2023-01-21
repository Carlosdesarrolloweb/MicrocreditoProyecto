<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pago', function (Blueprint $table) {
          
            $table->datetime('fecha_pago');
            $table->double('monto', 10, 2)->nullable();

            $table->unsignedBigInteger('id_prestamo');
            $table->foreign('id_prestamo')->references('id')->on('prestamo')->onDelete('cascade');
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
        Schema::dropIfExists('detalle_pago', function (Blueprint $table) {                     
            $table->dropConstrainedForeignId('id_prestamo');  
            $table->dropConstrainedForeignId('id_pago');
        });
    }
}
