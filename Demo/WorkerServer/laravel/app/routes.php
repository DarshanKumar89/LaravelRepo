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
Route::get('queue/send', function()
{

	$data = ['title' => 'Welcome to sourceeasyteam!'];
	Mail::queue('emails.sendmail', $data, function($m){
	   $m->to('darshan@sourceeasy.com', 'Tester');
	   $m->subject('Welcome to sourceeasyteam');
	});
	return 'Done';
});

Route::get('/', function()
{
	return View::make('hello');
});

Route::post('queue/receive',function(){

	Log::info('marshal!');

return Queue::marshal();


});

Route::resource('email','EmailController',['except' => ['create', 'edit']]);