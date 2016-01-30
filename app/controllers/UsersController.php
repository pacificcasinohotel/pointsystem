<?php

class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(ACL::checkUserPermission('settings.user') == false){
			return Redirect::action('dashboard');
		}

		$userList   = User::all();
		$title 		= Lang::get('User');
		$status 	= array('0' => array('label'   => 'default' ,'status'  => 'Inactive'), 
					    	'1' => array('label'  => 'success', 'status' => 'Active'));

		return View::make('user/index', 	array(
						  'acl'		 => ACL::buildACL(),
						  'userList' => $userList,
						  'title'	 => $title,
						  'status'	 => $status
						));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(ACL::checkUserPermission('user.create') == false){
			return Redirect::action('dashboard');
		}

		$title 	   = Lang::get('Add User');
		$formOpen  = Form::open(array('method' => 'post', 'id' => 'form-user','class' => 'smart-form', 'route' => array('user.store')));
		$formClose = Form::close();
		$groupList = ACL::getAllGroup();

		return View::make('user/create', 	array(
						  'formOpen'	   => $formOpen,
						  'formClose'	   => $formClose,
						  'groupList' 	   => $groupList,	
						  'title'	  	   => $title
						));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		if(ACL::checkUserPermission('user.create') == false){
			return Redirect::action('dashboard');
		}

		$rules = array(
    			'username' => 'required|unique:acl_users|alpha_num',
    			'password' => 'required|min:8|different:username',
    			'email' => 'required|email');

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			$messages = $validator->messages();
			return Redirect::action('user.create')
							->withInput(Input::except('password'))
							->with('error', $messages->all());
		}
		else
		{
			$user = new User;
    		$user->username   	= Input::get('username');
    		$user->fullname   	= Input::get('fullname');
    		$user->email   	  	= Input::get('email');
    		$user->password   	= Hash::make(Input::get('password'));
    		$user->company_name	= Input::get('company');
    		$user->confirmed  	= Input::get('confirm');	
    		$user->created_at 	= new DateTime;
    		$user->last_password_change = new DateTime;

    		//Set Password Expiration Date
    		$settingsExpiry = Settings::getSettingValue('password_expiry');
    		$user->password_expiration_date = User::userPasswordExpiry(date("Y-m-d H:i:s"), $settingsExpiry); 
			
			$temp = array();
			$temp[] = Hash::make(Input::get('password'));
			$user->passwords = json_encode($temp);
			
    		$user->save();
    		
    		if (Input::has('usermember'))
    		{
    			$usermember = Input::get('usermember');
    			ACL::userMemberAddEdit($user->id,$usermember);
    		}
    		$message = 'User has been created';
    		return Redirect::action('settings.user')->with('success', $message);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(ACL::checkUserPermission('user.show') == false){
			return Redirect::action('dashboard');
		}

		$title 	        = Lang::get('User Info');
		$userInfo   	= User::find($id);
		$userMember     = UserMember::with('group')->where('user_id',$id)->get();
		$userAccess		= ACL::checkPermission($id);

		if(!empty($userInfo))
		{
			return View::make('user/show', 	array(
						  	  'userInfo' 	   => $userInfo,
						  	  'userMember'	   => $userMember,
						  	  'userAccess'	   => $userAccess['access'],
						  	  'title'	  	   => $title
						));
		}
		else
		{

			$message = 'Cannot find User Info';
			return Redirect::Action('settings.user')->with('error', $message);

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
		if(ACL::checkUserPermission('user.edit') == false){
			return Redirect::action('dashboard');
		}

		$userInfo 		 = User::find($id);
		$groupList  	 = ACL::getAllGroup();
		$userMember      = ACL::getUserMember($id);

		if(!empty($userInfo))
		{
			$title 	   = Lang::get('Edit User');
			$formOpen  = Form::open(array('method' => 'post', 'id' => 'form-user','class' => 'smart-form', 'route' => array('user.update', $id)));
			$formClose = Form::close();

			return View::make('user/edit', 	array(
						  'formOpen'	   => $formOpen,
						  'formClose'	   => $formClose,
						  'groupList' 	   => $groupList,
						  'userInfo'	   => $userInfo,
						  'userMember'	   => $userMember,		
						  'title'	  	   => $title
						));
		}
		else
		{
			$message = 'Cannot find UserInfo';
			return Redirect::action('settings.user')->with('error', $message);
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

		if(ACL::checkUserPermission('user.edit') == false){
			return Redirect::action('dashboard');
		}

		$user = User::where('id', $id)->find($id);

		$input = Input::all();

		$user->username   	= Input::get('username');
    	$user->fullname   	= Input::get('fullname');
    	$user->email   	  	= Input::get('email');
    	$user->company_name	= Input::get('company');
    	$user->confirmed  	= Input::get('confirm');	

    	If (Input::has('changepassword'))
    	{
    		if(User::checkUserPassword($id,Input::get('password')) == true){
    			$msgType = 'error'; 
				$message = 'Password has been used before by the user. <br /> 
				Change the user\'s password at least 5 times before using the password again.';

				return Redirect::action('user.edit')->with($msgType, $message);
    		}

    		$user->password = Hash::make(Input::get('changepassword'));
    		$user->last_password_change = new DateTime;
			$passwords = json_decode($user->passwords,true);
			
			if(sizeof($passwords) == 0){
				$temp = array();
				$temp[] = Hash::make(Input::get('password'));
				$user->passwords = json_encode($temp);
			}else{
				array_push($passwords,Hash::make(Input::get('password')));
				if(sizeof($passwords) > 5){
					array_shift($passwords);
				}

				$user->passwords = json_encode($passwords);
			}
    		
    	}

    	$user->save(); 	

		if (Input::has('usermember'))
		{
			$userMember = Input::get('usermember');
			UserPermissions::where('user_id', '=',$user->id)->delete();
			ACL::userMemberAddEdit($user->id,$userMember);
		}
		else
		{
			UserPermissions::where('user_id', '=',$user->id)->delete();
			UserMember::where('user_id', '=', $id)->delete();
		}

		$message = 'User has been modified';
		return Redirect::action('settings.user')->with('success', $message);	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(ACL::checkUserPermission('user.delete') == false){
			return Redirect::action('dashboard');
		}

		$user = User::where('id', $id)->find($id);
 		
		if(!empty($user))
		{
			$user->delete();
			$msg_type = 'success'; 
			$message  = 'User delete success';
		}
		else	
		{
			$msg_type = 'error'; 
			$message = 'User delete failed';
		}

		return Redirect::action('settings.user')->with($msg_type, $message);

	}

	public function permission($id)
	{
		if(ACL::checkUserPermission('user.permission') == false){
			return Redirect::action('dashboard');
		}

		$userInfo 	   = User::find($id);

		if(!empty($userInfo))
		{
			$title 		= Lang::get('Edit Permission');
			$formOpen  	= Form::open(array('method' => 'post', 'class' => 'bf', 'route' => array('user.update.permission', $id)));
			$formClose 	= Form::close();
			$selectFormPermmission   = ACL::selectFormPermmission($id);

			return View::make('user/permission', 	array(
						  	  'formOpen'	   => $formOpen,
						  	  'formClose'	   => $formClose,
						  	  'userInfo'	   => $userInfo,
						  	  'select'		   => $selectFormPermmission,
						  	  'title'	  	   => $title
						));
		}
		else
		{
			$message = 'Cannot find UserInfo';
			return Redirect::action('settings.user')->with('error', $message);
		}
	}

	public function updatepermission($id)
	{
		if(ACL::checkUserPermission('user.permission') == false){
			return Redirect::action('dashboard');
		}

		if (Input::has('permission'))
		{
			$permission = Input::get('permission');
			$userpermission = ACL::saveUserPermission($id,$permission);
		}
		else
		{
			UserPermissions::where('user_id', '=', $id)->delete();
		}

		$message = 'User Permission has been modified';
		return Redirect::action('')->with('success', $message);
	}

	public function login()
    {
        if ( Auth::user() ) {
            // If user is logged, redirect to internal
            // page, change it to '/admin', '/dashboard' or something
            return Redirect::action('dashboard');
        } else {
        	$formOpen  	= Form::open(array('method' => 'post', 'id'=> 'login-form' , 'class' => 'smart-form client-form', 'route' => array('user.login')));
			$formClose 	= Form::close();

			return View::make('user/login', 	array(
						  	  'formOpen'	   => $formOpen,
						  	  'formClose'	   => $formClose
						));
        }
    }

    public function do_login()
	{  

		$input = array(
            'username'	  	=> Input::get('username'), // May be the username too
            'password' 	 	=> Input::get('password'),
            'confirmed' 	=> 1
        );

        if (Auth::attempt($input))
        {
        	$r = Session::get('loginRedirect');
            if (!empty($r)) {
                Session::forget('loginRedirect');
            }

           	//update last login and ip address
            User::updateLoginTime();
            User::updateSessionToken();

            Session::put('temp_username','');
        	Session::put('login_attempts',0);

            return Redirect::action('dashboard'); 
        }
        else
        {
    		$temp_username = Session::get('temp_username');
        	$count = Session::get('login_attempts');
        	if(empty($temp_username) || $temp_username != Input::get('username')){
        		Session::put('temp_username',Input::get('username'));
        		Session::put('login_attempts',1);
        	}else if($temp_username == Input::get('username')){
        		Session::put('login_attempts',$count+1);
        	}	

        	if(Session::get('login_attempts') >= 3){
	    		$user = User::where('username','=', Input::get('username'))->first();
	    		if(isset($user->id)){
    				if($user->status == 1){
		    			$user = User::where('id', $user->id)->find($user->id);
				    	$user->status = 0;
				    	$user->save();
			    	}
		    	}
		    	$err_msg = 'Your account is locked. Please contact your administrator to unlock your account';
        	}else{
        		$err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
        	}
        	return Redirect::action('login.index')
                            ->withInput(Input::except('password'))
                            ->with( 'error', $err_msg );
        }
	}

	public function logout()
    {
        Auth::logout();
        Session::flush();
        
        return Redirect::action('login.index');
    }

    public function updateStatus($id = null){

    	$user   = User::where('id', $id)->find($id);

    	//1 for unlocked 0 for locked
    	if($user->status == 1){
    		$user->status = 0;
    	}else{
    		$user->status = 1;
    	}

    	if($user->save())
		{
			$msgType = 'success'; 
			$message  = 'User\'s status was changed succesfully';
		}
		else
		{
			$msgType = 'error'; 
			$message = 'User\'s status change failed';
		}

		return Redirect::action('settings.user')->with($msgType, $message);
    }


    public function profile()
    {   
    	$userInfo   = Auth::user();

    	if (Request::isMethod('post'))
    	{	
    		$id   = Auth::user()->id;
    		
    		if(User::checkUserPassword($id,Input::get('password')) == true){
    			$msgType = 'error'; 
				$message = 'Password has been used before. <br /> 
				Change your password at least 5 times before using this password again.';

				return Redirect::action('user.profile')->with($msgType, $message);
    		}

    		$user = User::where('id', $id)->find($id);
    		$user->password   				= Hash::make(Input::get('password'));
    		$user->last_password_change 	= new DateTime;
    		$settingsExpiry 				= Settings::getSettingValue('password_expiry');
    		$user->password_expiration_date = User::userPasswordExpiry(date("Y-m-d H:i:s"), $settingsExpiry); 
			$passwords = json_decode($user->passwords,true);
			

			if(sizeof($passwords) == 0){
				$temp = array();
				$temp[] = Hash::make(Input::get('password'));
				$user->passwords = json_encode($temp);
			}else{
				array_push($passwords,Hash::make(Input::get('password')));
				if(sizeof($passwords) > 5){
					array_shift($passwords);
				}

				$user->passwords = json_encode($passwords);
			}

    		if($user->save())
    		{
    			$msgType = 'success'; 
				$message  = 'Password has been changed';
    		}
    		else
    		{
    			$msgType = 'error'; 
				$message = 'Password has been failed';
    		}

    		return Redirect::action('user.profile')->with($msgType, $message);
    	}
    	else
    	{
    		$title 		= Lang::get('My Profile');
    		return View::make('user/profile', 	array(
						  	  'userInfo' => $userInfo,
						  	  'title'	 => $title));
    	}
    }

    public function resetPassword($id = null){
    	$user   = User::where('id', $id)->find($id);

    	$user->password   = Hash::make('gl0b33st4t3');

    	if($user->save())
		{
			$msgType = 'success';
			$message  = 'User\'s password was reset succesfully';
		}
		else
		{
			$msgType = 'error'; 
			$message = 'User\'s password reset failed';
		}

		return Redirect::action('settings.user')->with($msgType, $message);
    }
}
