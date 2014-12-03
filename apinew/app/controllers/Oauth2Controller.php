<?php

class Oauth2Controller extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function authorize()
	{
		Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(
            Input::get(),
            array(
                'redirect_uri' =>'sometimes|url|max:50',
                'grant_type' =>'sometimes|alpha_num|max:50',
                'client_id' =>'sometimes|exists:oauth2_clients,strClientKey|alpha_num|min:5|max:100',
                'client_secret' =>'sometimes|alpha_num|min:5|max:100',
                'username' =>'sometimes|email',
                'password' =>'sometimes',
                'scopes' =>'sometimes'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }

        switch (Input::get('grant_type')) {
        	case 'code':
        		# code...
        		break;
			case 'password':
        	case 'token':
        			if (Auth::validate(array('strUserEmail' => Input::get('username'), 'password' => Input::get('password'))))
					{
						$access_token = Hash::make(sha1(time()));
						
						if(Input::get('grant_type')=='token')
						{      
							$userId = User::where('strUserEmail','=',Input::get('username'))->pluck('intUserId');
							DB::insert('insert into oauth2_accesstoken (intUserId, strClientKey,strAccessToken,tsmExpires) values (?, ?, ?, NOW())', array($userId, Input::get('client_id'),$access_token));
						}
					    return $this->respond([
					    		'object' => 'session',
					    		'username' => Input::get('username'),
					    		'access_token' => $access_token
					    	]); 
					}
					else
					{
						return $this->respondUnauthorizedError('Invalid Credentials');
					}
        		break;
        	
        	default:
        		# code...
        		break;
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
