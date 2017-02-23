<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('teamA');
            $table->integer('teamB');
            $table->integer('goalA');
            $table->integer('goalB');
            $table->integer('tournament_id')->unsigned();
            $table->integer('round_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchings');
    }
}
