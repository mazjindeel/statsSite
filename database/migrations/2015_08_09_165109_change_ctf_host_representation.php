<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCtfHostRepresentation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ctf', function (Blueprint $table) {
            $table->dropColumn('team_a_host');
            $table->dropColumn('team_b_host');
            $table->integer('team_host_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ctf', function (Blueprint $table) {
            $table->integer('team_a_host')->nullable();
            $table->integer('team_b_host')->nullable();
            $table->dropColumn('team_host_id');
        });
    }
}
