<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('users', 'User');
Route::model('roles', 'Role');
//Route model binding makes controller testing hard with Mockery.
//Route::model('widgets', 'Widget');

Route::get('/', function()
{
	return Redirect::to('admin/');
});

Route::group(array('prefix' => 'admin/'), function()
{	
	//Login
	Route::get('/',  array('as'=>'login.index','uses' => 'UsersController@login'));
	Route::post('/', array('as' => 'user.login' , 'uses' => 'UsersController@do_login'));
	Route::get('logout',  array('as'=>'user.logout','uses' => 'UsersController@logout'));

	// Profile for active user
	Route::get('user/profile/',	array('as' => 'user.profile','before'=> 'auth|auth.session|auth.status','uses' => 'UsersController@profile'));
	Route::post('user/profile/',	array('as' => 'user.profile','before'=> 'auth|auth.session|auth.status','uses' => 'UsersController@profile'));
	Route::get('user/reset_password/{id}',	array('as' => 'user.reset','before'=> 'auth|auth.session|auth.status','uses' => 'UsersController@resetPassword'));

	Route::get('redeem/points/',  array('as'=>'redeem.points','uses' => 'RedeemPointsController@index'));
});



// Route group for API versioning
// Route::group(array('prefix' => 'admin/v1/','before'=>'auth|auth.session|auth.status|password_change|password_expiry'), function()
Route::group(array('prefix' => 'admin/','before'=>'auth|auth.session|auth.status|check_merchant'), function()
{	
	
	Route::get('dashboard',  array('as'=>'dashboard','uses' => 'BaseController@dashboard'));
	Route::get('accesssite',  array('as'=>'access.site','uses' => 'UsersController@index'));
	Route::get('accessadmin',  array('as'=>'access.admin','uses' => 'UsersController@index'));
	Route::get('permissiondenied', array('as' => 'denied','uses' => 'BaseController@permissionDenied'));
	
	// Group / Role Management
	Route::get('groups', array('as'=>'settings.groups','uses' => 'GroupController@index'));
	Route::get('groups/show/{id}', 	array('as'=>'groups.show','uses' => 'GroupController@show'));
	Route::get('groups/create', array('as'=>'groups.create','uses' => 'GroupController@create'));
	Route::post('groups/store', array('as' => 'groups.store','uses' => 'GroupController@store'));
	Route::get('groups/edit/{id}', 		array('as'=>'groups.edit','before'=> 'auth.permission|auth.session','uses' => 'GroupController@edit'));
	Route::post('groups/update/{id}', 	array('as' => 'groups.update','uses' => 'GroupController@update'));
	Route::get('groups/delete/{id}',	array('as'=>'groups.delete','before'=> 'auth.permission|auth.session','uses' => 'GroupController@destroy'));
	Route::get('groups/permission', array('as'=>'groups.permission','before'=> 'auth.session', 'uses' => 'GroupController@permission'));
	Route::post('groups/updatepermission', array('as'=>'groups.update.permission','before'=> 'auth.session', 'uses' => 'GroupController@updatePermission'));

	//User Management
	Route::get('user', array('as' => 'settings.user','uses' => 'UsersController@index'));
	Route::get('user/show/{id}', 	array('as'=>'user.show','uses' => 'UsersController@show'));
	Route::get('user/create', array('as' => 'user.create','uses' => 'UsersController@create'));
	Route::post('user/store', array('as' => 'user.store','uses' => 'UsersController@store'));
	Route::get('user/edit/{id}', array('as' => 'user.edit','uses' => 'UsersController@edit'));
	Route::post('user/update/{id}', array('before' => 'csrf','as' => 'user.update','uses' => 'UsersController@update'));
	Route::get('user/delete/{id}',	array('as' => 'user.delete','before'=> 'auth.permission','uses' => 'UsersController@destroy'));
	Route::get('user/permission/{id}',	array('as' => 'user.permission','before'=> 'auth.permission','uses' => 'UsersController@permission'));
	Route::post('user/updatepermission/{id}', array('before' => 'csrf', 'as' => 'user.update.permission','uses' => 'UsersController@updatepermission'));
	Route::get('user/updatestatus/{id}', array('as' => 'user.update.status','uses' => 'UsersController@updateStatus'));
	
	
	//Permission Management
	Route::get('permission', array('as' => 'settings.permission','uses' => 'PermissionController@index'));
	Route::get('permission/show/{id}', 	array('as'=>'permission.show','uses' => 'PermissionController@show'));
	Route::get('permission/create', array('as' => 'permission.create','uses' => 'PermissionController@create'));
	Route::post('permission/store', array('as' => 'permission.store','uses' => 'PermissionController@store'));
	Route::get('permission/edit/{id}', array('as' => 'permission.edit','uses' => 'PermissionController@edit'));
	Route::post('permission/update/{id}', array('as' => 'permission.update','before' => 'csrf','uses' => 'PermissionController@update'));
	Route::get('permission/delete/{id}', array('as' => 'permission.delete','before'=> 'auth.permission','uses' => 'PermissionController@destroy'));

	//Settings Management
	Route::get('settings', array('as' => 'settings.index','uses' => 'SettingsController@index'));
	Route::get('settings/create', array('as'=>'settings.create','uses' => 'SettingsController@index'));
	Route::get('settings/edit/{id}', array('as' => 'settings.edit','uses' => 'SettingsController@edit'));
	Route::post('settings/update/{id}', array('as' => 'settings.update','before' => 'csrf','uses' => 'SettingsController@update'));

	//Player Management
	Route::get('player/', array('as' => 'player.index','uses' => 'PlayerController@index'));
	Route::post('player/', array('as' => 'player.upload','uses' => 'PlayerController@upload'));
	Route::get('player/show/{id}', 	array('as'=>'player.show','uses' => 'PlayerController@show'));
	Route::get('player/create', array('as' => 'player.create','uses' => 'PlayerController@create'));
	Route::post('player/store', array('as' => 'player.store','before' => 'csrf','uses' => 'PlayerController@store'));
	Route::get('player/rfid/', array('as' => 'player.rfid','uses' => 'PlayerController@rfid'));
	Route::get('player/edit/{id}', array('as' => 'player.edit','uses' => 'PlayerController@edit'));
	Route::put('player/update/{id}', array('as' => 'player.update','before' => 'csrf','uses' => 'PlayerController@update'));
	
	//Points Management
	Route::get('points', array('as'=>'points.index','uses' => 'PointsController@player'));
	Route::post('points', array('as'=>'points.index','uses' => 'PointsController@bets'));
	Route::get('points', array('as'=>'points.player','uses' => 'PointsController@player'));
	Route::get('points/logout/{id}',array('as'=>'points.logout','uses' => 'PointsController@logout'));
	
	Route::get('points/redeem/',array('as'=>'points.redeem','uses' => 'RedeemPointsController@index'));
	Route::get('points/rfid/', array('as' => 'points.rfid','uses' => 'PointsController@rfid'));
	Route::post('points/redeem/',array('as'=>'points.redeem.post','uses' => 'RedeemPointsController@post'));

	Route::get('reports', array('as'=>'reports.index','uses' => 'ReportsController@coupon'));
	Route::get('reports/redeem/', array('as'=>'reports.redeem','uses' => 'ReportsController@coupon'));
	Route::get('reports/bets/', array('as'=>'reports.bets','uses' => 'ReportsController@bets'));

});
