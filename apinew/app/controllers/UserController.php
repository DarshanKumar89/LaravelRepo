<?php

use Platform\Transformers\UserTransformer;

class UserController extends ApiController {

	protected $userTransformer;

	function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$validator = Validator::make(
            array(
                'limit' => Input::get('limit'),
                'page' => Input::get('page')
            ),
            array(
                'limit' => 'sometimes|numeric',
                'page' => 'sometimes|numeric'
            )
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid pagination request.');
        }

        $limit = (Input::get('limit')<100) ? Input::get('limit') : 100;
		$users = User::paginate($limit);
        return $this->respondWithPagination($users,[
            'object' => 'list',
            'data' => $this->userTransformer->transformCollection($users->all())
        ]);
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
		Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(
            Input::all(),
            array(
                'userFname' =>'required|max:50',
                'userLname' =>'required|max:50',
                'userPassword' =>'required|min:5|max:50',
                'userEmail' =>'required|unique:users,strUserEmail|email',
                'userIsActive' =>'required'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $user = new User;
        $user->strUserFname = Input::get('userFname');
        $user->strUserLname = Input::get('userLname');
        $user->strUserPassword = Hash::make(Input::get('userPassword'));
        // $user->strUserPassword =Input::get('userPassword');
        $user->strUserEmail = Input::get('userEmail');
        $user->bolIsActive = (Input::get('userIsActive')==='true') ? 1 : 0;
        try {
            $user->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save User.');
        }
        $insertedUser = User::find($user->intUserId);

        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->userTransformer->transform($insertedUser));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($userId)
	{
		$validator = Validator::make(
            array('intUserId' => $userId),
            array('intUserId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid User Id.');
        }
        $user = User::find($userId);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }
        return $this->respond( $this->userTransformer->transform($user));
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
	public function update($userId)
	{
		Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(
            array('intUserId' => $userId),
            array('intUserId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid User Id.');
        }

        $user = User::find($userId);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }

        $validator = Validator::make(
            Input::all(),
            array(
                'userFname' =>'sometimes|max:50',
                'userLname' =>'sometimes|max:50',
                'current_password' =>'required_with:userPassword|min:5|max:50',
                'userPassword' =>'required_with:current_password|min:5|max:50',
                'userEmail' =>'sometimes|email',
                'userIsActive' =>'sometimes'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $user->strUserFname = Input::get('userFname')?Input::get('userFname'):$user->strUserFname;
        $user->strUserLname = Input::get('userLname')?Input::get('userLname'):$user->strUserLname;
        if(Input::get('userPassword') && Input::get('current_password'))
        {
            if(Hash::check(Input::get('current_password'),$user->strUserPassword))
            {
                $user->strUserPassword = Input::get('userPassword')?Hash::make(Input::get('userPassword')):$user->strUserPassword;
            }
            else
            {
                return $this->respondUnauthorizedError('Invalid User password.');
            }
        }
        $user->strUserEmail = Input::get('userEmail')?Input::get('userEmail'):$user->strUserEmail;

        $user->bolIsActive = Input::get('userIsActive')?((Input::get('userIsActive')==='true') ? 1 : 0):$user->bolIsActive;
        try {
            $user->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save User.');
        }
        $updatedUser = User::find($userId);

        return $this->setStatusCode(ApiController::HTTP_OK)->respond($this->userTransformer->transform($updatedUser));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($userId)
	{
		$validator = Validator::make(
            array('intUserId' => $userId),
            array('intUserId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid User Id.');
        }

        $user = User::withTrashed()->find($userId);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }
        if ($user->trashed()) {
            return $this->respondNotModified('User already deleted.');
        }

        try{

           $user->delete();
 //        Delete other things also
        }
        catch (Exception $e)
        {
            return $this->respondInternalError('Unable to delete User.');
        }
        return $this->respondOk('User deleted.');
	}

    public function ban($userId)
    {
        $validator = Validator::make(
            array('intUserId' => $userId),
            array('intUserId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid User Id.');
        }
        $user = User::find($userId);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }
        $user->bolIsActive = 0;
        $user->save();
        return $this->respondOk('User banned.');

    }


}
