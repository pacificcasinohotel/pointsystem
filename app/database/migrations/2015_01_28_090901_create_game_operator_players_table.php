<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameOperatorPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_operator_players', function($table)
        {
	        $table->increments('id');
	      	$table->integer('operator_id')->unsigned();
	      	$table->integer('player_id')->unsigned();
	      	$table->foreign('operator_id')->references('id')->on('acl_users')->onDelete('cascade');
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
		Schema::drop('game_operator_players');
	}

}
