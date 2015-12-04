<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameChannelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_channel', function($table)
        {
        	$table->increments('id');
	        $table->string('channel_id', 36);
	        $table->integer('table_id',false)->unsigned();
	      	// $table->integer('operator_id',false)->unsigned();
	      	$table->tinyInteger('channel_status')->default('1');
	      	// $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
	      	// $table->foreign('operator_id')->references('id')->on('acl_users')->onDelete('cascade');
	      	$table->foreign('table_id')->references('id')->on('game_tables')->onDelete('cascade');
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
		Schema::drop('game_channel');
	}

}
