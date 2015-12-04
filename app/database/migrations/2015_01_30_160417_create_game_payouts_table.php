<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamePayoutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_payouts', function($table)
        {
			$table->increments('id')->unsigned();
	    	$table->string('bet');
	    	$table->string('name');
	    	$table->string('payout');
	    	$table->string('percentage');
	    	$table->string('numbers_covered')->default(0);
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
		Schema::drop('game_payouts');
	}

}
