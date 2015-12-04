<?php

class Points extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player_points';

	protected $fillable = array('account_id', 'credits');

	protected $guarded = array('id');

	public $timestamps = true;

	public function playerpoints()
	{
		return $this->belongsto('User','account_id')->select('id','username','fullname');
	}

	public function account_credits()
	{
		return $this->belongsto('User','account_id');
	}

}
