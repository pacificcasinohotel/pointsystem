<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerRedeemCouponTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('player_coupon', function($table)
        {
	        $table->increments('id')->unsigned();
	        $table->integer('player_id',false)->unsigned();
	        $table->integer('redeem_by',false)->unsigned();
	        $table->string('coupon_code')->nullable();
	        $table->decimal('points', 15, 2)->default(0);
	        $table->boolean('redeemed')->default(false);
	        $table->foreign('player_id')->references('id')->on('acl_users');
	        $table->foreign('redeem_by')->references('id')->on('acl_users');
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
		Schema::drop('player_coupon');
	}

}
