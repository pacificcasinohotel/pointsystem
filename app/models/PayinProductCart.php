<?php

class PayinProductCart extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ac_payin_product_cart';

	public $timestamps = false;

	public function payinproductcart()
	{
		return $this->hasMany('PayinCart','invoice_id','invoice_id');
	}

	public function product()
	{
		return $this->hasOne('Product','product_id','product_id')
			->select(array(
				'product_id',
				'product_name',
				'product_description',
				'product_price',
				'product_shipping'
			));
	}

	public function payincart()
	{
		return $this->hasMany('PayinCart','invoice_id','invoice_id');
	}
}
