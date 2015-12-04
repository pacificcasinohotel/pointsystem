<?php

class Gamebets extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game_bets';

	protected $fillable = array(
		'player_id', 
		'channel_id',
		'bet_number',
		'bet_amount',
		'bet_type',
		'bet_result',
		'bet_status'
	);

	protected $guarded = array('id');

	public $timestamps = true;

	public function betdetails()
	{
		return $this->belongsto('Gamechannel','channel_id');
	}

	public function playerdetails()
	{
		return $this->belongsto('User','player_id')->select('id','username','fullname');
	}

	public function payout()
	{
		return $this->hasOne('Gamepayouts','name','bet_type')->select();
	}

	public function channel()
	{
		return $this->hasOne('Gamechannel','id','channel_id')->select();
	}

}