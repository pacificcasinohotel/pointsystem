<?php

class Gamepayouts extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game_payouts';

	protected $fillable = array(
		'bet', 
		'name',
		'payout',
		'percentage',
		'numbers_covered'
	);

	protected $guarded = array('id');

	public $timestamps = true;

}