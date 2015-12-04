<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundinoutTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fundinout', function($table)
        {
	        $table->increments('id')->unsigned();
	        $table->integer('wallet_id',false)->unsigned();
	        $table->integer('onbehalf',false)->unsigned();
	      	$table->double('credits', 15, 2)->default(0);
	      	$table->string('description');
	      	$table->string('fundtype');
	        $table->foreign('wallet_id')->references('id')->on('wallet')->onDelete('cascade');
	        $table->foreign('onbehalf')->references('id')->on('acl_users')->onDelete('cascade');
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
		Schema::drop('fundinout');
	}

}
