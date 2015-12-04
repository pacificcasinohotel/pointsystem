<?php

class Gamechannel extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game_channel';

	protected $fillable = array(
		'channel_id',
		'table_id',
		'channel_status'
	);

	protected $guarded = array('id');
	
	public $timestamps = true;

	public function tabledetails()
	{
		return $this->belongsTo('Gametables','table_id');
	}

	public function bets()
	{
		return $this->hasMany('Gamebets','channel_id','id');
	}

	public function scopeOpenchannel($query)
    {
        return $query->where('channel_status' , 1);
    }

}