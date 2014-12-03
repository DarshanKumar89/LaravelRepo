<?php

class SchemasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		 $users = Schema::all();

        return View::make('users.index', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	
		// load the create form (app/views/schemas/create.blade.php)
		return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			// store
		 $input = Input::all();
        $validation = Validator::make($input, Schema::$rules);

        if ($validation->passes())
        {
            Schema::create($input);

            return Redirect::route('users.index');
        }

        return Redirect::route('users.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the schemas
		$user = Schema::find($id);

		// show the view and pass the schemas to it
		return View::make('users.show')
			->with('users', $user);
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
		$user = Schema::find($id);
        if (is_null($user))
        {
            return Redirect::route('users.index');
        }
        return View::make('users.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// store
			 $input = Input::all();
        $validation = Validator::make($input, Schema::$rules);
        if ($validation->passes())
        {
            $user = Schema::find($id);
            $user->update($input);
            return Redirect::route('users.show', $id);
        }
return Redirect::route('users.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		Schema::find($id)->delete();
        return Redirect::route('users.index');
	}


}
