<?php

class Playeroperators extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game_operator_players';

	protected $fillable = array(
		'player_id', 
		'operator_id'
	);

	protected $guarded = array('id');
	
	public $timestamps = true;

	public function opdetails()
	{
		return $this->belongsto('User','operator_id')->select('id','username','fullname','email');
	}

	public function tabledetails()
	{
		return $this->belongsto('Gametables','operator_id','operator_id');
	}

	public function playerdetails()
	{
		return $this->belongsto('User','player_id')->select('id','username','fullname','email');
	}

	public function credits()
	{
		return $this->hasOne('Wallet', 'account_id' , 'player_id');
	}

}