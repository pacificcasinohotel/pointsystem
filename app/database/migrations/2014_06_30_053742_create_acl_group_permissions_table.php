<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclGroupPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('acl_group_permissions', function ($table) {
		 	$table->increments('id')->unsigned();
            $table->integer('permission_id',false)->unsigned();
            $table->integer('group_id',false)->unsigned();
            $table->boolean('value')->default(true);
            $table->foreign('permission_id')->references('id')->on('acl_permissions')->onDelete('cascade');
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
		Schema::drop('acl_group_permissions');
	}

}
