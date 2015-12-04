<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclUserPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acl_user_permissions', function ($table) {
			$table->increments('id')->unsigned();
        	$table->integer('user_id',false)->unsigned();
        	$table->integer('permission_id',false)->unsigned();
        	$table->boolean('value')->default(true);
        	$table->foreign('user_id')->references('id')->on('acl_users')->onDelete('cascade'); // assumes a users table
        	$table->foreign('permission_id')->references('id')->on('acl_permissions')->onDelete('cascade');
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
		Schema::drop('acl_user_permissions');
	}

}
