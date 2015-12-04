<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameBetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('game_bets', function($table)
        {
	        $table->increments('id');
	      	$table->integer('player_id',false)->unsigned();
	      	$table->integer('channel_id')->unsigned();
	      	$table->string('bet_number');
	      	$table->decimal('bet_amount', 15, 2)->default(0); 
	      	$table->string('bet_type');
	      	$table->string('bet_result', 10);
	      	$table->tinyInteger('bet_status')->default('1'); 
	      	$table->foreign('player_id')->references('id')->on('acl_users')->onDelete('cascade');
	      	$table->foreign('channel_id')->references('id')->on('game_channel');
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
		Schema::drop('game_bets');
	}

}
