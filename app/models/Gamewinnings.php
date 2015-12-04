<?php

class Gamewinnings extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game_winnings';

	protected $fillable = array(
		'game_id', 
		'channel_id',
		'winning_number'
		);

	protected $guarded = array('id');

	public $timestamps = true;

	public function channel()
	{
		return $this->belongsto('Gamechannel','channel_id','id');
	}
}