<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWaveItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wave_items', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('wave_id');
            $table->bigInteger('item_id');
            $table->integer('count');
            $table->index(['wave_id']);
            $table->index(['item_id']);
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
        Schema::dropIfExists('wave_items');
    }
}
