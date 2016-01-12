<?php

class Playerbets extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player_bets';

	protected $fillable = array(
		'account_id',
		'added_by', 
		'bet',
		'points_conversation',
		'points_converted'
	);

	protected $guarded = array('id');

	public $timestamps = true;


	public function playerdetails()
	{
		return $this->belongsto('User','account_id')->select('id','username','fullname');
	}

}