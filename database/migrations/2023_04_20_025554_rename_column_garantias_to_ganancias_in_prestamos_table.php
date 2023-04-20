<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnGarantiasToGananciasInPrestamosTable extends Migration
{
    public function up()
    {
        Schema::table('prestamo', function (Blueprint $table) {
            $table->renameColumn('garantia', 'ganancia');
        });
    }

    public function down()
    {
        Schema::table('prestamo', function (Blueprint $table) {
            $table->renameColumn('ganancia', 'garantia');
        });
    }
}
