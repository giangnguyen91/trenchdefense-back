<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLeaderBoards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leader_boards', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('game_user_id');
            $table->bigInteger('wave_id');
            $table->index(['game_user_id']);
            $table->index(['wave_id']);
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
        Schema::dropIfExists('leader_boards');
    }
}
