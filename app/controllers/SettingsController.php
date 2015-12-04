<?php

class SettingsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(ACL::checkUserPermission('settings.index') == false){
			return Redirect::action('dashboard');
		}

		$title = Lang::get('Setting List');
		$settingList = Settings::all();		
		$acl  = ACL::buildACL();
		$data = array(
			'title' 		=> $title,
			'acl'			=> $acl,
			'settingList'	=> $settingList
		);

		return View::make('settings/index', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(ACL::checkUserPermission('settings.index') == false){
			return Redirect::action('dashboard');
		}

		$settingsInfo = Settings::find($id);

		if(!empty($settingsInfo))
		{
			$title 		= Lang::get('Edit Setting');
			$formOpen  = Form::open(array('method' => 'post', 'id' => 'form-settings','class' => '', 'route' => array('settings.update', $id)));
			$formClose = Form::close();

			$data = array(
				'title' 		=> $title, 
				'formOpen'		=> $formOpen,
				'formClose'		=> $formClose,
				'settingsInfo'	=> $settingsInfo
			);

			return View::make('settings/edit',$data);
		}
		else
		{
			$message = 'Cannot find SettingsInfo';
			return Redirect::action('settings.index')->with('error', $message);
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
		if(ACL::checkUserPermission('settings.index') == false){
			return Redirect::action('dashboard');
		}

		$settings = Settings::where('id', $id)->find($id);

		$settings->display_name = Input::get('display_name');
    	$settings->value     	= Input::get('value');
		$settings->updated_at	= date('Y-m-d H:i:s');   
    	
    	if($settings->save())
    	{
    		$messageType = 'success';
    		$message     = 'Setting edit success';
    	}
    	else
    	{
    		$messageType = 'error';
    		$message     = 'Setting edit failed';
    	}

    	return Redirect::action('settings.index')->with($messageType, $message);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
