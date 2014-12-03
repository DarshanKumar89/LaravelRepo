<?php

//@todo:  Move this to a filter
header('Access-Control-Allow-Origin: *');
header_remove('X-Powered-By');
//header('Content-Type: application/json');
header('Connection: close');


Route::get('/',function(){
	
    return Response::json(["Bruce Wayne: It's not who I am underneath, but what I do that defines me."],200);

});

Route::get('oauth2/authorize',['as' => 'oauth2.authorize','uses' => 'Oauth2Controller@authorize']);
Route::resource('oauth2/clients','Oauth2ClientController',['except' => ['create', 'edit']]);

Route::get('/chat/{room}',['as'=>'chat.show', 'uses' => 'ChatController@show']);
Route::post('/chat/{room}/message',['as'=>'chat.message', 'uses' => 'ChatController@message']);

Route::group(['prefix' => 'v1'], function(){
	
	Route::resource('users','UserController',['except' => ['create', 'edit']]);
	Route::post('users/{user}/remind', 'RemindersController@postRemind');
	Route::post('users/{user}/reset', 'RemindersController@postReset');
	Route::get('users/{user}/ban', 'UserController@ban');

	Route::resource('roles','RoleController',['except' => ['create', 'edit']]);
	
	Route::resource('scopes','ScopeController',['except' => ['create', 'edit']]);
	
	Route::resource('vendors','VendorController',['except' => ['create', 'edit']]);
	Route::resource('vendors.contact','VendorContactController',['except' => ['create', 'edit']]);
	Route::resource('vendors.address','VendorAddressController',['except' => ['create', 'edit']]);
	Route::resource('vendors.baccount','VendorBAccountController',['except' => ['create', 'edit']]);

	Route::get('users/{user}/roles',['as' => 'v1.users.roles.index','uses' => 'UserRoleController@roles']);
	Route::get('roles/{role}/users',['as' => 'v1.roles.index.index','uses' => 'UserRoleController@users']);
	Route::get('users/{users}/roles/{roles}/authorize',['as' => 'v1.users.roles.authorize','uses' => 'UserRoleController@authorize']);
	Route::get('users/{users}/roles/{roles}/revoke',['as' => 'v1.users.roles.revoke','uses' => 'UserRoleController@revoke']);
	
	Route::post('session',['as' => 'v1.session.store','uses' => 'SessionController@store']);
	Route::get('session/delete',['as' => 'v1.session.delete','uses' => 'SessionController@destroy']);
	Route::get('session/status',['as' => 'v1.session.status','uses' => 'SessionController@show']);
});


/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/
/*Route::get('/resource',function(){
	//This will go to a function
	$access_token = Input::get('access_token');
	if(!$access_token)
	{
		return "Access Denied need access token";
	}

	$auth = DB::table('oauth2_accesstoken')->where('strAccessToken', Input::get('access_token'))->pluck('intUserId');
	if(!$auth)
	{
		return "Invalid Access Token";
	}
	echo "You are accessing ".User::find($auth)->pluck('strUserFname'). " resource";


});*/