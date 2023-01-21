<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateTablas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_foto');
            $table->foreign('id_foto')->references('id')->on('foto')->onDelete('cascade');
        });
        Schema::table('garantias', function (Blueprint $table) {
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
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_foto');

        });
        Schema::table('garantias', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_foto');

        });
    }  
}
