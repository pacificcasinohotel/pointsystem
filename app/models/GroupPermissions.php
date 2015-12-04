<?php

class GroupPermissions extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'acl_group_permissions';

	#protected $fillable = array('name', 'description');

	public $timestamps = false;

	public function aclPermission()
	{
		return $this->hasOne('Permission', 'id' , 'permission_id');
	}

	public function group()
	{
		return $this->hasOne('Group', 'id' , 'group_id');
	}

	public static function getGroupPermission($groupIds)
	{
		$groupPermission = DB::table('acl_group_permissions')->select(array('acl_permissions.*'))
   		->distinct()
		->join('acl_permissions', 'acl_permissions.id','=', 'acl_group_permissions.permission_id')
		->whereIn('acl_group_permissions.group_id', $groupIds)
		->orderBy('acl_permissions.perm_key', 'asc')
		->get();

		return $groupPermission;
	}

}
