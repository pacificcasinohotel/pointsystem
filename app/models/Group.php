<?php

class Group extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'acl_groups';

	protected $fillable = array('name', 'description');

	public $timestamps = false;

	public function users()
	{
		return $this->belongsToMany('User', 'acl_users');
	}

	public function getUsermember()
	{
		return $this->hasMany('UserMember', 'group_id' , 'id');
	}

}
