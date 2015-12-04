<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclUserMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acl_user_member', function ($table) {
        	$table->integer('user_id',false)->unsigned();
        	$table->integer('group_id',false)->unsigned();
        	$table->foreign('user_id')->references('id')->on('acl_users')->onDelete('cascade'); // assumes a users table
        	$table->foreign('group_id')->references('id')->on('acl_groups')->onDelete('cascade');
        	$table->timestamp('date_created');
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acl_user_member');
	}

}
