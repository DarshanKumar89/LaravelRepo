<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex() {
		$items = Item::all();
		return View::make('index', array(
			'items'	=> $items
			));
	}

	public function postIndex() {
		$id = Input::get('id');
		$item = Item::findOrFail($id);
		$item->mark();

		return Redirect::to('/');
	}

	public function getList($id) {
		$items = Item::find($id);
		$tasks = Task::all();
		$checklists = DB::table('tasks')->where('item_id', '=', $id)->get();

		return View::make('single', array(
			'items' => $items,
			'tasks' => $tasks,
			'checklists' => $checklists
			));
	}

	public function postList($id) {
		$id = Input::get('id');
		$task = Task::findOrFail($id);
		$task->mark();

		return Redirect::route("/item/{id}");
	}

	public function getNewTask() {
		return View::make('new');
	}

	public function postNewTask() {
		$rules = array('name' => 'required|min:3|max:255');
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/new')->withErrors($validator);
		}

		$item = new Item;
		$item->name = Input::get('name');
		$item->save();

		return Redirect::to('/');
	}

	public function getNewChecklist() {
		return View::make('task');
	}

	public function postNewChecklist() {
		// $id = DB::
		$rules = array('name' => 'required|min:3|max:255');
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/new/checklist')->withErrors($validator);
		}

		$task = new Task;
		$task->name = Input::get('name');
		$task->due_date = Input::get('date');
		// $task->item_id = $id;
		$task->save();

		return Redirect::to('/');
	}

	public function getEdit($task) {
	}

	public function getDelete(Item $task) {
		$task->delete();

		return Redirect::to('/');
	}

}
