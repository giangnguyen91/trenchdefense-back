<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableZoombieItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drop_items', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('zombie_id');
            $table->bigInteger('item_id');
            $table->float('drop_rate');
            $table->index(['zombie_id']);
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
        Schema::dropIfExists('drop_items');
    }
}
