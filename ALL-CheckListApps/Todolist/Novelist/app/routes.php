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


Route::bind('task', function($value, $route) {
	return Item::where('id', $value)->first();
});



Route::get('/', 'HomeController@getIndex');

Route::post('/', array('uses' => 'HomeController@postIndex'))->before('csrf');



Route::get('/item/{id}', 'HomeController@getList');

Route::post('/item/{id}', array('as' => 'checklist', 'uses' => 'HomeController@postList'));



Route::get('/new', 'HomeController@getNewTask');

Route::post('/new', 'HomeController@postNewTask');

Route::get('/new/checklist', 'HomeController@getNewChecklist');

Route::post('/new/checklist', 'HomeController@postNewChecklist');



Route::get('/edit/{task}', array('as' => 'edit', function($task) {
		$item = Item::where('id', '=', 1);
		var_dump($item);
		// return View::make('edit')
		// 	->with('task', $task)
		// 	->with('item', $item);
}));

Route::post('/edit', function() {
	$rules = array('name' => 'required|min:3|max:255');
	$validator = Validator::make(Input::all(), $rules);

	if ($validator->fails()) {
		return Redirect::to('/new')->withErrors($validator);
	}

	$item = new Item;
	$item->name = Input::get('name');
	$item->save();

	return Redirect::to('/');
});



Route::get('/delete/{task}', array('as' => 'delete', 'uses' => 'HomeController@getDelete'));