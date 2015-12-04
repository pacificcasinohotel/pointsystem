<?php

class Permission extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'acl_permissions';

	protected $fillable = array('perm_name', 'perm_key');

	public $timestamps = false;

	
	public function groups()
	{
		return $this->belongsToMany('Group', 'acl_group_permissions');
	}

}
