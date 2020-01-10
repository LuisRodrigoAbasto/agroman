<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('ip',20)->nullable();
            $table->string('usuario_sap',50)->nullable();
            $table->string('password_sap',50)->nullable();
            $table->string('usuario_ad',50)->nullable();
            $table->string('password_ad',50)->nullable();
            $table->string('telefono_ip',50)->nullable();
            $table->boolean('estado')->default(1);
            $table->foreign('usuario_id')->references('id')->on('usuarios');
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
        Schema::dropIfExists('cuentas');
    }
}
