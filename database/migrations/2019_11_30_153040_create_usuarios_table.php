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
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('empresa_id');
            $table->string('nombre',50)->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            // $table->string('password_office')->nullable();
            $table->string('celular',50)->nullable();
            $table->string('corto',50)->nullable();
            $table->string('interno',50)->nullable();
            $table->boolean('estado')->default(1);
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('empresa_id')->references('id')->on('empresas');
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
