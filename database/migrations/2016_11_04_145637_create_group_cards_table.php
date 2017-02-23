<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('groupNumber');
            $table->boolean('done');
            $table->integer('statistic_id')->unsigned();
            $table->integer('tournament_id')->unsigned();
            $table->integer('team_id')->unsigned();


        });
    }

    public function down()
    {
        Schema::dropIfExists('group_cards');
    }
}
