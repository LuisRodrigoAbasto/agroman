<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sucursal_id');
            $table->string('direccion_ip',20);
            $table->string('usuario',50);
            $table->string('usuario_sap',50);
            $table->string('usuario_ad',50);
            $table->string('password_ad',50);
            $table->string('email_office',50);
            $table->string('password_office',50);
            $table->string('telefono_ip',50);
            $table->foreign('sucursal_id')->references('id')->on('sucursal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
