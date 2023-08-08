<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ganancia_dia', function (Blueprint $table) {
            $table->double('ganancia', 10, 2)->default(0)->after('efectivo');
        });
    }

    public function down()
    {
        Schema::table('ganancia_dia', function (Blueprint $table) {
            $table->dropColumn('ganancia');
        });
    }
};
