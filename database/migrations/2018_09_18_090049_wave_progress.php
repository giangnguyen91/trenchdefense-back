<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WaveProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wave_progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('game_user_id');
            $table->bigInteger('wave_id');
            $table->bigInteger('status');
            $table->unique(['game_user_id', 'wave_id']);
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
        Schema::dropIfExists('wave_progresses');
    }
}
