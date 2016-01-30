<?php

class GroupController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(ACL::checkUserPermission('settings.groups') == false){
			return Redirect::action('dashboard');
		}

		$groupList = Group::all();
		$title 	   = Lang::get('Group');
		$acl       = ACL::buildACL();
		return View::make('groups/index', 	array(
						  'groupList' => $groupList,
						  'title'	  => $title
						));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(ACL::checkUserPermission('groups.create') == false){
			return Redirect::action('dashboard');
		}

		$title 		= Lang::get('Add Group');
		$formOpen  = Form::open(array('method' => 'post', 'id' => 'form-group','class' => 'smart-form', 'route' => array('groups.store')));
		$formClose = Form::close();
		$permissionList  = Permission::all();
		
		return View::make('groups/create', 	array(
						  'formOpen'	  => $formOpen,
						  'formClose'	  => $formClose,
						  'permissonList' => $permissionList,	
						  'title'	  	  => $title
						));

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(ACL::checkUserPermission('groups.create') == false){
			return Redirect::action('dashboard');
		}

		$group = new Group;
    	$group->name = Input::get('name');
    	$group->description  = Input::get('description');
    	$group->date_created = new DateTime;  	
    	$group->save();

    	if (Input::has('permission'))
		{
			$permission = Input::get('permission');
			ACL::saveGroupPermission($group->id,$permission);
		}

		$message = 'Group has been created';
		return Redirect::action('settings.groups')->with('success', $message);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(ACL::checkUserPermission('groups.show') == false){
			return Redirect::action('dashboard');
		}

		$title 	     = Lang::get('Group Info');
		$groupInfo   = Group::find($id);
		$groupAccess = GroupPermissions::with('aclPermission')->where('group_id', $id)->get();

		if(!empty($groupInfo))
		{
			return View::make('groups/show', 	array(
						  	  'groupInfo' 	  => $groupInfo,
						  	  'groupAccess'	  => $groupAccess,
						  	  'title'	  	  => $title
						));
		}
		else
		{

			$message = 'Cannot find GroupInfo';
			return Redirect::action('settings.groups')->with('error', $message);

		}


	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(ACL::checkUserPermission('groups.edit') == false){
			return Redirect::action('dashboard');
		}

		$groupInfo 		 = Group::find($id);
		$permissionList  = Permission::all();
		$groupPermission = GroupPermissions::where('group_id', $id)->get();
		$gPermission 	 = array();

		foreach ($groupPermission as $row) {
			$gPermission[] = $row->permission_id;
		}

		if(!empty($groupInfo))
		{
			$title 	   = Lang::get('Edit Groups');
			$formOpen  = Form::open(array('method' => 'post', 'id' => 'form-group','class' => 'smart-form', 'route' => array('groups.update', $id)));
			$formClose = Form::close();

			return View::make('groups/edit', 	array(
						  	  'groupInfo' 	  => $groupInfo,
						  	  'permissonList' => $permissionList,
						  	  'groupPermission' => $gPermission,
						  	  'formOpen'	  => $formOpen,
						  	  'formClose'	  => $formClose,	
						  	  'title'	  	  => $title
						));
		}
		else
		{
			$message = 'Cannot find GroupInfo';
			return Redirect::action('settings.groups')->with('error', $message);
		}

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(ACL::checkUserPermission('groups.edit') == false){
			return Redirect::action('dashboard');
		}

		$group = Group::where('id', $id)->find($id);

		$name 		 = Input::get('name');
		$description = Input::get('description');

		$group->name = $name;
		$group->description = $description;
		$group->save();

		if (Input::has('permission'))
		{
			$permission = Input::get('permission');
			ACL::saveGroupPermission($id,$permission);
		}

		$messageType = 'success';
		$message     = 'Group edit success';

		return Redirect::action('settings.groups')->with($messageType, $message);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(ACL::checkUserPermission('groups.delete') == false){
			return Redirect::action('dashboard');
		}

		$group = Group::where('id', $id)->find($id);
 		
		if(!empty($group))
		{
			$group->delete();
			$messageType = 'success'; 
			$message  = 'Group delete success';
		}
		else	
		{
			$messageType = 'error';
			$message  = 'Group delete failed';
		}

		return Redirect::action('settings.groups')->with($messageType, $message);

	}

	public function permission()
	{
		if(ACL::checkUserPermission('groups.edit') == false){
			return Redirect::action('dashboard');
		}

		$groupList = Group::all();
		$permissionList  = Permission::all();
		$groupPermission = ACL::getGroupPermission();
		$formOpen  = Form::open(array('method' => 'post', 'id' => 'form-group-permission','class' => 'smart-form', 'route' => array('groups.update.permission')));
		$formClose = Form::close();
		$title = Lang::get('Group Permission');

		return View::make('groups/permission', 	array(
						  'groupList' => $groupList,
						  'permissionList' => $permissionList,
						  'groupPermission' => $groupPermission,
						  'formOpen'  => $formOpen,
						  'formClose' => $formClose,		
						  'title'	  => $title
						));
	}

	public function updatePermission()
	{
		if(ACL::checkUserPermission('groups.edit') == false){
			return Redirect::action('dashboard');
		}

		if (Input::has('permission'))
		{
			$permission = Input::get('permission');
			foreach ($permission as $key => $value) {
				ACL::saveGroupPermission($key,$value);

			}

		}

		$messageType = 'success';
		$message     = 'Group edit permission success';

		return Redirect::action('settings.groups')->with($messageType, $message);
	}

}
