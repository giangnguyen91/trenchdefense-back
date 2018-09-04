<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableZoombies extends Migration
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
            $table->text('name');
            $table->bigInteger('damage');
            $table->bigInteger('hp');
            $table->bigInteger('speed');
            $table->bigInteger('attack');
            $table->text('resource_id')->nullable();
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
