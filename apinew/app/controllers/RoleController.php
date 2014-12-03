<?php

use Platform\Transformers\RoleTransformer;

class RoleController extends ApiController {

	protected $roleTransformer;

	function __construct(RoleTransformer $roleTransformer)
    {
        $this->roleTransformer = $roleTransformer;
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
		$roles = Role::paginate($limit);
        return $this->respondWithPagination($roles,[
            'object' => 'list',
            'data' => $this->roleTransformer->transformCollection($roles->all())
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
            Input::all(),
            array(
                'roleName' =>'required|unique:roles,strRoleName|alpha_spaces|max:50',
                'roleDesc' =>'required|alpha_spaces|max:200',
                'roleIsActive' =>'required'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $role = new Role;
        $role->strRoleName = Input::get('roleName');
        $role->strRoleDesc = Input::get('roleDesc');
        $role->bolIsActive = (Input::get('roleIsActive')==='true') ? 1 : 0;
        try {
            $role->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save Role.');
        }
        $insertedRole = Role::find($role->intRoleId);

        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->roleTransformer->transform($insertedRole));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($roleId)
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
                'roleName' =>'sometimes|alpha_spaces|max:50',
                'roleDesc' =>'sometimes|alpha_spaces|max:200',
                'roleIsActive' =>'sometimes'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $role->strRoleName = Input::get('roleName')?Input::get('roleName'):$role->strRoleName;
        $role->strRoleDesc = Input::get('roleDesc')?Input::get('roleDesc'):$role->strRoleDesc;
        $role->bolIsActive = Input::get('roleIsActive')?((Input::get('roleIsActive')==='true') ? 1 : 0):$role->bolIsActive;
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
