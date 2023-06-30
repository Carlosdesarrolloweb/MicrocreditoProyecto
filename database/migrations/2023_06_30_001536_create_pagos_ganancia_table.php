<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosGananciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_ganancia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pago');
            $table->unsignedBigInteger('id_ganancia_dia');
            $table->timestamps();

            $table->foreign('id_pago')->references('id')->on('pagos')->onDelete('cascade');
            $table->foreign('id_ganancia_dia')->references('id')->on('ganancia_dia')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos_ganancia');
    }
}
