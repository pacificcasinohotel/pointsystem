<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the users table
        Schema::create('acl_users', function($table)
        {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('fullname');
            $table->string('email');
            $table->string('company_name')->nullable();
            $table->string('ip_address', 39);
            $table->text('return_url')->nullable();
            $table->dateTime('last_login');
            $table->string('last_login_ip');
            $table->string('password');
            $table->text('passwords')->nullable();
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(false);
            $table->boolean('rfid_login')->default(false);
            $table->string('rfid_serial')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->string('session_token')->nullable();
            $table->string('remember_token')->nullable();
            $table->dateTime('last_password_change')->nullable();
            $table->dateTime('password_expiration_date')->nullable();
            $table->dateTime('account_expiration_date')->nullable();
            $table->timestamps();
        });

        $statement = "ALTER TABLE acl_users AUTO_INCREMENT = 0;";
        DB::unprepared($statement);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acl_users');
	}

}
