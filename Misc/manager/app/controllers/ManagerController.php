<?php

class NerdController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		// get all the nerds
		$managers = Manager::all();

		// load the view and pass the nerds
		return View::make('managers.index')
			->with('managers', $managers);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		// load the create form (app/views/nerds/create.blade.php)
		return View::make('managers.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'name'       => 'required',
			'label'      => 'required',
			'data'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('managers/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$manager = new Manager;
			$manager->name       = Input::get('name');
			$manager->label      = Input::get('label');
			$manager->data       = Input::get('data');
			$manager->save();

			// redirect
			Session::flash('message', 'Successfully created schemas!');
			return Redirect::to('managers');
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
		//
		// get the nerd
		$manager = Manager::find($id);

		// show the view and pass the nerd to it
		return View::make('managers.show')
			->with('manager', $manager);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		// get the nerd
		$manager = Manager::find($id);

		// show the edit form and pass the nerd
		return View::make('managers.edit')
			->with('manager', $manager);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'name'       => 'required',
			'label'      => 'required',
			'data'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('managers/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$manager = Manager::find($id);
			$manager->name       = Input::get('name');
			$manager->label      = Input::get('label');
			$manager->data       = Input::get('data');
			$manager->save();

			// redirect
			Session::flash('message', 'Successfully updated schemas!');
			return Redirect::to('managers');
		}
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
		// delete
		$manager = Manager::find($id);
		$manager->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the schemas!');
		return Redirect::to('managers');
	}


}
