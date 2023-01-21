<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            
           
            $table->unsignedBigInteger('id_prestamo');
            $table->foreign('id_prestamo')->references('id')->on('prestamo')->onDelete('cascade');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos', function (Blueprint $table) {                     
            $table->dropConstrainedForeignId('id_prestamo');  
            $table->dropConstrainedForeignId('id_usuario');
        });

        
    }
}
