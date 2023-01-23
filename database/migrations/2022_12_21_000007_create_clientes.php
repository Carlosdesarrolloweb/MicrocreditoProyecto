<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('Carnet_cliente',20);
            $table->string('nombre_cliente',30);
            $table->string('apellido_cliente',30);
            $table->longText('direccion_cliente');
            $table->string('email_cliente');
            $table->string('telefono_cliente',15);
            $table->string('edad_cliente');
            $table->string('telefono_referencia');
            $table->string('estado_cliente');
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
