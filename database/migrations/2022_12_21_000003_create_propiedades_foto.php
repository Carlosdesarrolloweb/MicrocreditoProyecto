<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiedadesFoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiedades_foto', function (Blueprint $table) {
            $table->id();
            $table->string('formato',20)->nullable();
            $table->string('medidas',20)->nullable();
            $table->string('peso',20)->nullable();
            $table->unsignedBigInteger('id_foto');
            $table->foreign('id_foto')->references('id')->on('foto')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propiedades_foto', function (Blueprint $table) {            
            $table->dropForeign('id_foto');
            $table->dropIndex('id_foto');
            $table->dropColumn('id_foto');
        });
          
    }
   
}
