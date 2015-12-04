<?php

class Games extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'games';

	protected $fillable = array('game_name', 'game_description');

	protected $guarded = array('id');

	public $timestamps = true;

}