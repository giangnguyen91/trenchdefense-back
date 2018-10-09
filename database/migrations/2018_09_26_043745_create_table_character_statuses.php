<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCharacterStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('game_user_id');
            $table->bigInteger('character_id');
            $table->integer('hp');
            $table->integer('wave_id');
            $table->integer('drop_gold');
            $table->text('weapons');
            $table->index(['game_user_id']);
            $table->index(['character_id']);
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
        Schema::dropIfExists('character_statuses');
    }
}
