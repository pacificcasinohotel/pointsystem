<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerBetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('player_bets', function($table)
        {
	        $table->increments('id')->unsigned();
	        $table->integer('account_id',false)->unsigned();
	      	$table->integer('added_by',false)->unsigned();
	      	$table->decimal('bet', 15, 2)->default(0);
	        $table->decimal('points_conversation', 15, 2)->default(0);
	        $table->decimal('points_converted', 15, 2)->default(0);
	        $table->foreign('account_id')->references('id')->on('acl_users');
	        $table->foreign('added_by')->references('id')->on('acl_users');
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
		Schema::drop('player_bets');
	}

}
