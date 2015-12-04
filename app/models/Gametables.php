<?php

class Gametables extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game_tables';

	protected $fillable = array(
		'game_id', 
		'operator_id',
		'table_name'
	);

	protected $guarded = array('id');
	
	public $timestamps = true;

	public function gamedetails()
	{
		return $this->belongsto('Games','game_id','id');
	}

	public function operator()
	{
		return $this->belongsto('User','operator_id')->select('id','username','fullname','email');
	}

	public function channels()
	{
		return $this->hasMany('Gamechannel','table_id', 'id');
	}
	
}