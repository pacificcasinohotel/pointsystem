<?php

class UserPermissions extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'acl_user_permissions';

	#protected $fillable = array('user_id', 'group_id','date_created');

	public $timestamps = false;

	public function permission()
	{
		return $this->belongsTo('Permission', 'permission_id', 'id');
	}


}
	