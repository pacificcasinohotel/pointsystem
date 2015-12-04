<?php

class Fundinout extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fundinout';

	protected $fillable = array('wallet_id', 'onbehalf','credits','description','fundtype');

	protected $guarded = array('id');

	public $timestamps = true;

	public function operator()
	{
		return $this->belongsto('User','onbehalf')->select('id','username','fullname');
	}

	public function wallet()
    {
        return $this->hasOne('Wallet', 'id' , 'wallet_id');
    }
}