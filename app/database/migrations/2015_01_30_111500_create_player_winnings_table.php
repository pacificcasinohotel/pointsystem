<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerWinningsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('player_winnings', function($table)
        {
			$table->increments('id')->unsigned();
	    	$table->integer('game_id',false)->unsigned();
	    	$table->integer('bet_id',false)->unsigned();
	    	$table->string('bet_type', 36);
	    	$table->string('winning_number', 36);
	    	$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
	    	$table->foreign('bet_id')->references('id')->on('game_bets')->onDelete('cascade');
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
		Schema::drop('player_winnings');	
	}

}
