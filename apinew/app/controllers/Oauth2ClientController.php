<?php

use Platform\Transformers\Oauth2ClientTransformer;

class Oauth2ClientController extends ApiController {

	protected $oauth2ClientTransformer;

	function __construct(Oauth2ClientTransformer $oauth2ClientTransformer)
    {
        $this->oauth2ClientTransformer = $oauth2ClientTransformer;
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
		$oauth2Clients = Oauth2Client::paginate($limit);
        return $this->respondWithPagination($oauth2Clients,[
            'object' => 'list',
            'data' => $this->oauth2ClientTransformer->transformCollection($oauth2Clients->all())
        ]);
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
            Input::get(),
            array(
                'user_id' =>'required|exists:users,intUserId|numeric',
                'redirect_uri' =>'required',
                'grant_type' =>'required'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $oauth2Client = new Oauth2Client;
        $oauth2Client->strClientKey = md5(time());
        $oauth2Client->strClientSecret = sha1(time());
        $oauth2Client->intUserId = Input::get('user_id');
        $oauth2Client->strRedirectUri = Input::get('redirect_uri');
        $oauth2Client->strGrantType = Input::get('grant_type');
        try {
            $oauth2Client->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save Oauth2 Client.');
        }
        $insertedOauth2Client = Oauth2Client::find($oauth2Client->intClientId);

        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->oauth2ClientTransformer->transform($insertedOauth2Client));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($oauth2ClientKey)
	{
		$validator = Validator::make(
            array('intClientKey' => $oauth2ClientKey),
            array('intClientKey' => 'required')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Client Key.');
        }
        if(is_numeric($roleId))
        $role = Role::find($roleId);
        else
        $role = Role::where('strRoleName','=',$roleId)->first();

        if (!$role) {
            return $this->respondNotFound('Role does not exist.');
        }
        return $this->respond( $this->roleTransformer->transform($role));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($roleId)
	{
		Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(
            array('intRoleId' => $roleId),
            array('intRoleId' => 'required|alpha_num')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Role Id.');
        }
        if(is_numeric($roleId))
        $role = Role::find($roleId);
        else
        $role = Role::where('strRoleName','=',$roleId)->first();

        // $role = Role::find($roleId);

        if (!$role) {
            return $this->respondNotFound('Role does not exist.');
        }

        $validator = Validator::make(
            Input::get(),
            array(
                'role_name' =>'sometimes|alpha_spaces|max:50',
                'role_desc' =>'sometimes|alpha_spaces|max:200',
                'is_active' =>'sometimes'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $role->strRoleName = Input::get('role_name')?Input::get('role_name'):$role->strRoleName;
        $role->strRoleDesc = Input::get('role_desc')?Input::get('role_desc'):$role->strRoleDesc;
        $role->bolIsActive = Input::get('is_active')?((Input::get('is_active')==='true') ? 1 : 0):$role->bolIsActive;
        try {
            $role->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save Role.');
        }
        $updatedRole = Role::find($roleId);

        return $this->setStatusCode(ApiController::HTTP_OK)->respond($this->roleTransformer->transform($updatedRole));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($roleId)
	{
		$validator = Validator::make(
            array('intRoleId' => $roleId),
            array('intRoleId' => 'required|alpha_num')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Role Id.');
        }
        if(is_numeric($roleId))
        $role = Role::withTrashed()->find($roleId);
        else
        $role = Role::withTrashed()->where('strRoleName','=',$roleId)->first();



        if (!$role) {
            return $this->respondNotFound('Role does not exist.');
        }
        if ($role->trashed()) {
            return $this->respondNotModified('Role already deleted.');
        }

        try{

           $role->delete();
 //        Delete other things also
        }
        catch (Exception $e)
        {
            return $this->respondInternalError('Unable to delete Role.');
        }
        return $this->respondOk('Role deleted.');
	}


}
