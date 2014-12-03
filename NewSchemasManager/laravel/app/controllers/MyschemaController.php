<?php

class MyschemaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return Response::json(Myschema::get());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/myschemas/create.blade.php)
		return View::make('myschemas.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		Myschema::create(array(
			'name' => Input::get('name'),
			'label' => Input::get('label'),
			'data' => Input::get('data')
		));

		return Response::json(array('success' => true));
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
		// get the schemas


		return Response::json(Myschema::find($id));
          
		// show the view and pass the schemas to it
		
		//return Redirect::to('myschemas');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the schemas
		return Response::json(Myschema::find($id));
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
		Myschema::create(array(
			'name' => Input::get('name'),
			'label' => Input::get('label'),
			'data' => Input::get('data')
		));

		return Response::json(array('success' => true));
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
		Myschema::destroy($id);

		return Response::json(array('success' => true));
	}


}
