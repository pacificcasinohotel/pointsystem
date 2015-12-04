<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function($table)
        {
			$table->engine = 'InnoDB';
	        $table->increments('id')->unsigned();
	        $table->string('name');
	        $table->string('display_name');
	        $table->string('value');
	        $table->string('type'); //password | configurable

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
		Schema::drop('settings');
	}

}
