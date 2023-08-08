<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFechaPagoInPagosTable extends Migration
{
    public function up()
    {


Schema::table('pagos', function (Blueprint $table) {
            $table->date('fecha_pago')->change();
        });
    }

    public function down()
    {


Schema::table('pagos', function (Blueprint $table) {


$table->timestamp('fecha_pago')->change();
        });
    }
}
