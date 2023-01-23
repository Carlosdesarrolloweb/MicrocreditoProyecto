<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_fotocarnet')->nulleable();
            $table->unsignedBigInteger('id_fotorecibo')->nulleable();
            $table->unsignedBigInteger('id_fotocroquis')->nulleable();
            $table->foreign('id_fotocarnet')->references('id')->on('foto')->onDelete('cascade');
            $table->foreign('id_fotorecibo')->references('id')->on('foto')->onDelete('cascade');
            $table->foreign('id_fotocroquis')->references('id')->on('foto')->onDelete('cascade');
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
            $table->dropConstrainedForeignId('id_fotocarnet');
            $table->dropConstrainedForeignId('id_fotorecibo');
            $table->dropConstrainedForeignId('id_fotocroquis');

            //
        });
    }
};
