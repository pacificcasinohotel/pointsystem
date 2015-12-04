<?php

class Merchant extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'acl_users';

	protected $guarded = array('id','username');

	public $timestamps = false;
	
}
