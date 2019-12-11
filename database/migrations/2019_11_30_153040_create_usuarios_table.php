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
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->string('empresa',20)->nullable();
            $table->string('direccion_ip',20)->nullable();
            $table->string('usuario',50)->nullable();
            $table->string('usuario_sap',50)->nullable();
            $table->string('usuario_ad',50)->nullable();
            $table->string('password_ad',50)->nullable();
            $table->string('email_office',50)->nullable();
            $table->string('password_office',50)->nullable();
            $table->string('telefono_interno',50)->nullable();
            $table->string('telefono_ip',50)->nullable();
            $table->string('celular',50)->nullable();
            $table->string('celular_corto',50)->nullable();
            $table->boolean('estado')->default(1);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
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
