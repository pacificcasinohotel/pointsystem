<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wallet', function($table)
        {
	        $table->increments('id')->unsigned();
	        $table->integer('account_id',false)->unsigned();
	      	$table->decimal('credits', 15, 2)->default(0);
	        $table->foreign('account_id')->references('id')->on('acl_users')->onDelete('cascade');
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
		Schema::drop('wallet');
	}

}
