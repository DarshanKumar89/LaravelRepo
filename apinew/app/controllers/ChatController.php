<?php

class ChatController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function message($roomId)
	{
		Input::merge(array_map('trim', Input::all()));
		$validator = Validator::make(
            array_merge(Input::all(),['room_id' => $roomId]),
            array(
                'room_id' =>'required',
                'from_id' =>'required',
                'from_name' =>'sometimes|alpha_spaces|min:1',
                'message' =>'required',
                'message_format' =>'sometimes',
                'notify' =>'sometimes',
                'color' =>'sometimes'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $pusher = new Pusher('bd51255b63e4d2408538', '7841a925632e5a93c1ed','83817');
		$pusher->trigger($roomId, 'message',['from_id'=> Input::get('from_id'),'from_name'=> Input::get('from_name') , 'message' => Input::get('message'), 'message_format' => Input::get('message'), 'notify' => Input::get('notify'), 'color' => Input::get('color')]);
		return Response::json(['status'=>'sent']);

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
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($roomId)
	{
		return View::make('chat.ui')->with(['room_id' => $roomId, 'room_name' => 'Rome' ]);
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
	}


}
