<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSndRoundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snd_round', function (Blueprint $table) {
            $table->increments('id');     
            $table->integer('snd_id');
            $table->integer('round_number');
            $table->text('side_won');
            $table->integer('victor_id');
            $table->integer('fb_player_id')->nullable();
            $table->integer('lms_player_id')->nullable();
            $table->integer('planter_id')->nullable();
            $table->text('plant_site')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('snd_round');
    }
}
