<?php

class Coupon extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player_coupon';

	protected $fillable = array('player_id', 'coupon_code','points','redeemed','redeem_by');

	protected $guarded = array('id');

	public $timestamps = true;

	public function playerdetails()
	{
		return $this->belongsto('User','player_id')->select('id','username','fullname');
	}

	public function redeemer()
	{
		return $this->belongsto('User','redeem_by')->select('id','username','fullname');
	}
}
