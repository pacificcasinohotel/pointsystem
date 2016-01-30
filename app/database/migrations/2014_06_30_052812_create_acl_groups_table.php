<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create groups table
		 Schema::create('acl_groups', function ($table) {
		 	$table->increments('id')->unsigned();
		 	$table->string('name', 50)->unique();
		 	$table->string('description', 255);
		 	$table->timestamp('date_created');
		 	$table->timestamp('date_updated')->default(DB::raw('CURRENT_TIMESTAMP'));
		 	#$table->foreign('id')->references('group_id')->on('acl_group_permission')->onDelete('cascade');
		 });

		$statement = "ALTER TABLE acl_groups AUTO_INCREMENT = 0;";
        DB::unprepared($statement);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acl_groups');
	}

}
