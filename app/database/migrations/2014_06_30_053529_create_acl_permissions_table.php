<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('acl_permissions', function ($table) {
		 	$table->increments('id')->unsigned();
		 	$table->string('perm_name');
		 	$table->string('perm_key');
		 	$table->text('perm_description')->nullable();
		 	$table->boolean('visible')->default(true);
		 	$table->timestamp('date_created');
            $table->timestamp('date_updated')->default(DB::raw('CURRENT_TIMESTAMP'));
		 });

		 $statement = "ALTER TABLE acl_permissions AUTO_INCREMENT = 0;";
        DB::unprepared($statement);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acl_permissions');	
	}

}
