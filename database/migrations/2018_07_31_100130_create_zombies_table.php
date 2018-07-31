<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZombiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zombies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('damage');
            $table->integer('hp');
            $table->integer('speed');
            $table->integer('armor');
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
        Schema::dropIfExists('zombies');
    }
}
