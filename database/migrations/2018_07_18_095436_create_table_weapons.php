<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWeapons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapon_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ammo_type');
            $table->timestamps();
        });

        Schema::create('weapons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('weapon_group_id')->unsigned();
            $table->integer('damage');
            $table->string('resource_id');
            $table->timestamps();
        });

        Schema::table('weapons', function (Blueprint $table){
            $table->foreign('weapon_group_id')->references('id')->on('weapon_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weapons');
        Schema::dropIfExists('weapon_groups');
    }
}
