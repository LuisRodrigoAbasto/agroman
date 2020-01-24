<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('red', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip',100)->unique();            
            $table->string('tabla',50)->nullable();
            $table->string('tabla_id',100)->nullable();
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('red');
    }
}
