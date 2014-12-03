<?php

class TodoController extends \BaseController {

public $restful = true;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() 
	{
		//
		if (is_null($id)) 
		{
			return Response::eloquent(Todo::all());
		} 
		else 
		{
			$todo = Todo::find($id);

			if(is_null($todo)){
			    return Response::json('Todo not found', 404);
			} else {
	        	    return Response::eloquent($todo);
			}
	
	}
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
		$newtodo = Input::json();

		$todo = new Todo();
		$todo->title = $newtodo->title;
		$todo->completed = $newtodo->completed;
		$todo->save();

		return Response::eloquent($todo);
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
		//
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
		$updatetodo = Input::json();

		$todo = Todo::find($updatetodo->id);
		if(is_null($todo)){
		    return Response::json('Todo not found', 404);
		}
		$todo->title = $updatetodo->title;
		$todo->completed = $updatetodo->completed;
		$todo->save();
		return Response::eloquent($todo);
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
		$todo = Todo::find($id);

		if(is_null($todo))
		{
		     return Response::json('Todo not found', 404);
		}
		$deletedtodo = $todo;
		$todo->delete();     
		return Response::eloquent($deletedtodo); 
	}


}
