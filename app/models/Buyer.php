<?php

class Buyer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ac_buyer_info';

	public $timestamps = false;

	public function payincart()
	{
		return $this->hasMany('PayinCart','buyer_id','buyer_id');
	}

	public static function buyerdetails($buyer_id)
	{
		$res = Buyer::where('buyer_id',$buyer_id)->first();
		return $res;
	}

	public static function buyerinfo($buyer_id)
	{
		$res = Buyer::with(
				'payincart',
				'payincart.payinproductcart',
				'payincart.payinproductcart.product')
			->where('buyer_id',$buyer_id)
			->first();

		return $res;
	}
}
