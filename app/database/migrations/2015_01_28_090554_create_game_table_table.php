<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_tables', function($table)
        {
	        $table->increments('id');
	      	$table->integer('game_id',false)->unsigned();
	      	$table->integer('operator_id')->unsigned();
	      	$table->string('table_name');
	      	$table->foreign('operator_id')->references('id')->on('acl_users')->onDelete('cascade');
	      	$table->foreign('game_id')->references('id')->on('games');
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
		Schema::drop('game_tables');
	}

}
