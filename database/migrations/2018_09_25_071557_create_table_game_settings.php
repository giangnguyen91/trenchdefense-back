<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGameSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('game_user_id');
            $table->unsignedTinyInteger('volume');
            $table->integer('sfx');
            $table->integer('bgm');
            $table->index(['game_user_id']);
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
        Schema::dropIfExists('game_settings');
    }
}
