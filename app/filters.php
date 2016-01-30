<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) {
        Session::put('loginRedirect', Request::url());

        $errorMsg = 'Please login using your credentials';

        return Redirect::action('login.index')->with( 'error', $errorMsg );
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('auth.permission', function()
{
    $routeName = Route::currentRouteName();

    if (Auth::check())
    {
        $buildACL  = ACL::buildACL();

        if(!array_key_exists($routeName, $buildACL['access']))
        {
           return Redirect::action('denied');
        }
    }
    else
    {
        $errorMsg = 'Please login using your credentials';
        return Redirect::action('login.index')->with( 'error', $errorMsg ); 
    }

});

Route::filter('auth.session', function()
{
  
    if (Auth::check())
    {
       $user  = User::find(Auth::user()->id);
       $sessionToken = Session::get('_token');
       if($user->session_token != $sessionToken)
       {
           Auth::logout();
           Session::flush();
           $errorMsg = 'Only one login session is allowed.';
           return Redirect::action('login.index')->with( 'error', $errorMsg ); 
       }
       
    }
    else
    {
        $errorMsg = 'Please login using your credentials';
        return Redirect::action('login.index')->with( 'error', $errorMsg ); 
    }
});

Route::filter('auth.status', function()
{
  
    if (Auth::check())
    {
       $user  = User::find(Auth::user()->id);
       if($user->status == 0)
       {
           Auth::logout();
           Session::flush();
           $errorMsg = 'Your account is locked. Please contact your administrator to unlock your account';
           return Redirect::action('login.index')->with( 'error', $errorMsg ); 
       }
       
    }
    else
    {
        $errorMsg = 'Please login using your credentials';
        return Redirect::action('login.index')->with( 'error', $errorMsg ); 
    }
});

Route::filter('password_change', function(){
    if (Auth::check())
    {
       $user  = User::find(Auth::user()->id);
       if(Hash::check('gl0b33st4t3', $user->password))
       {
           $msgType = 'warning'; 
           $message = 'Your password has been reset. Please change your password';

           return Redirect::action('user.profile')->with($msgType, $message);
       }
       
    }
    else
    {
        $errorMsg = 'Please login using your credentials';
        return Redirect::action('login.index')->with( 'error', $errorMsg ); 
    }

});

Route::filter('password_expiry', function(){
    if (Auth::check())
    {
       $date           = date("Y-m-d H:i:s");
       $user           = Auth::user();
       $settingsExpiry = Settings::getSettingValue('password_expiry');
       $expirationDate = User::userPasswordExpiry($user->password_expiration_date, $settingsExpiry);

        if (strtotime($expirationDate) < strtotime($date)){
            $msgType = 'warning'; 
            $message = 'Your password has been expired. Please change your password.';

           return Redirect::action('user.profile')->with($msgType, $message);
        }
    }
    else
    {
        $errorMsg = 'Please login using your credentials';
        return Redirect::action('login.index')->with('error', $errorMsg); 
    }

});

Route::filter('check_merchant', function(){
    if (Auth::check())
    {
        $userMember = UserMember::with('group')->where('user_id',Auth::user()->id)->get();
        if($userMember->count() > 0)
        {
          $fetch = array_fetch($userMember->toArray(), 'group.name');
          if(in_array('Merchant', $fetch))
          {
              $merchant_id = Auth::user()->id;
              $merchant    = Merchant::find($merchant_id);

              $merchant_arr = array(
                          'merchant_id' =>  $merchant_id);

              Session::put('merchant', $merchant_arr);
          }
        }
    }
    else
    {
        $errorMsg = 'Please login using your credentials';
        return Redirect::action('login.index')->with('error', $errorMsg); 
    }

});


 
/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('user/login/');
});


/*
|--------------------------------------------------------------------------
| Role Permissions
|--------------------------------------------------------------------------
|
| Access filters based on roles.
|
*/

//Check for role on all admin routes
//Entrust::routeNeedsRole( 'admin*', array('admin'), Redirect::to('/') );

// Check for permissions on admin actions
//Entrust::routeNeedsPermission( 'admin/user*', 'manage_users', Redirect::to('/') );
//Entrust::routeNeedsPermission( 'admin/role*', 'manage_roles', Redirect::to('/') );

// Check for permissions on widget actions
//Entrust::routeNeedsPermission( 'widgets*', 'manage_widgets', Redirect::to('/') );

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
