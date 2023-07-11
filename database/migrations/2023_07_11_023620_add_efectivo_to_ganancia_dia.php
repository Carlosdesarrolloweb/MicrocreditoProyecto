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
        Schema::table('ganancia_dia', function (Blueprint $table) {
           
            $table->double('efectivo', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('ganancia_dia', function (Blueprint $table) {
            $table->dropColumn('efectivo');
        });
    }
};
