<?php

class PermissionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(ACL::checkUserPermission('settings.permission') == false){
			return Redirect::action('dashboard');
		}
		$permission  = Permission::all();
		$title  	 = Lang::get('Permission');
		$acl         = ACL::buildACL();
	    return View::make('permission/index', 	array(
						  'acl'		=> $acl,
						  'permissionList' => $permission,
						  'title'	 => $title
						));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(ACL::checkUserPermission('permission.create') == false){
			return Redirect::action('dashboard');
		}
		$title 		= Lang::get('Add Permission');
		$formOpen   = Form::open(array('method' => 'post', 'id' => 'form-permission','class' => 'smart-form', 'route' => array('permission.store')));
		$formClose = Form::close();
	
		return View::make('permission/create', 	array(
						  'formOpen'	  => $formOpen,
						  'formClose'	  => $formClose,
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
		$permission = new Permission;
    	$permission->perm_name  = Input::get('perm_name');
    	$permission->perm_key   = Input::get('perm_key');
    	$permission->visible   	= Input::get('visible');
    	$permission->date_created = new DateTime;  	
    	$permission->save();

		$message = 'Permission has been created';
		return Redirect::action('settings.permission')->with('success', $message);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(ACL::checkUserPermission('permission.show') == false){
			return Redirect::action('dashboard');
		}
		$title 	          = Lang::get('Permission Info');
		$permissionInfo   = Permission::find($id);

		if(!empty($permissionInfo))
		{
			return View::make('permission/show', 	array(
						  	  'permissionInfo' => $permissionInfo,
						  	  'title'	  	   => $title
						));
		}
		else
		{

			$message = 'Cannot find Permission Info';
			return Redirect::Action('settings.permission')->with('error', $message);

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
		if(ACL::checkUserPermission('permission.edit') == false){
			return Redirect::action('dashboard');
		}
		$permissionInfo = Permission::find($id);

		if(!empty($permissionInfo))
		{
			$title 		= Lang::get('Edit Permission');
			$formOpen  = Form::open(array('method' => 'post', 'id' => 'form-permission','class' => 'smart-form', 'route' => array('permission.update', $id)));
			$formClose = Form::close();

			return View::make('permission/edit', 	array(
						  	  'formOpen'	   => $formOpen,
						  	  'formClose'	   => $formClose,
						  	  'permissionInfo' => $permissionInfo,
						  	  'title'	  	   => $title
						));
		}
		else
		{
			$message = 'Cannot find PermissionInfo';
			return Redirect::action('settings.permission')->with('error', $message);
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
		if(ACL::checkUserPermission('permission.edit') == false){
			return Redirect::action('dashboard');
		}
		$permission = Permission::where('id', $id)->find($id);

		$permission->perm_name   	= Input::get('perm_name');
    	$permission->date_updated   = date('Y-m-d H:i:s');
    	
    	if($permission->save())
    	{
    		$messageType = 'success';
    		$message     = 'Permission edit success';
    	}
    	else
    	{
    		$messageType = 'error';
    		$message     = 'Permission edit failed';
    	}

    	return Redirect::action('settings.permission')->with($messageType, $message);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(ACL::checkUserPermission('permission.delete') == false){
			return Redirect::action('dashboard');
		}
		
		$permission = Permission::where('id', $id)->find($id);
 		
		if(!empty($permission))
		{
			$permission->delete();
			$messageType = 'success'; 
			$message  	 = 'Permission delete success';
		}
		else	
		{
			$messageType = 'error'; 
			$message = 'Permission delete failed';
		}

		return Redirect::action('settings.permission')->with($messageType, $message);
	}


}
