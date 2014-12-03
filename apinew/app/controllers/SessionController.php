<?php

class SessionController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(
            ['username'=>Input::json('username'),'password'=>Input::json('password')],
            array(
                'username' =>'required|exists:users,strUserEmail',
                'password' =>'required'
            ));
        if($validator->fails())
        {
           // return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }

        $user = User::where('strUserEmail','=',Input::get('username'))->where('bolIsActive','=','1')->first();
        
        if (!$user) {
            return $this->respondUnauthorizedError('User banned.');
        }

        if (Auth::attempt(array('strUserEmail' => Input::get('username'), 'password' => Input::get('password'))))
			{
			    return $this->respond([
			    		'object' => 'session',
			    		'username' => Input::get('username'),
			    		'status' => 'success',
			    		'token' => 'asas.vvv.sss.dddd'
			    	]); 
			}
			else
			{
				return $this->respondUnauthorizedError('Invalid Credentials');
			}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		if(Auth::check())
		{
			return Response::json(['status' => 'true',Session::all()]);
		}
		else
		{
			return Response::json(['status' => 'false']);
		}
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
	public function destroy()
	{
		Auth::logout();
		return $this->respondOk('Logout Successful');

	}


}
