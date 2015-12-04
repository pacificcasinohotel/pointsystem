<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameWinningsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('game_winnings', function($table)
        {
	        $table->increments('id')->unsigned();
	      	$table->integer('game_id',false)->unsigned();
	      	$table->integer('channel_id',false)->unsigned();
	      	$table->string('winning_number', 36);
	      	$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
	      	$table->foreign('channel_id')->references('id')->on('game_channel')->onDelete('cascade');
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
		Schema::drop('game_winnings');
	}

}
