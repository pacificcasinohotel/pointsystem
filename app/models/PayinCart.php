<?php

class PayinCart extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ac_payin_cart';

	public $timestamps = false;

	public function product()
	{
		return $this->hasOne('Product','product_id','product_id');
	}

	public function buyer()
	{
		return $this->hasOne('Buyer','buyer_id','buyer_id');
	}

	public function payinproductcart()
	{
		return $this->hasMany('PayinProductCart','invoice_id','invoice_id')
			->select(array(
				'invoice_id',
				'product_id',
				'quantity',
				'date_added'
			));
	}
}
