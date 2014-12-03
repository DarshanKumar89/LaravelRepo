<?php

use Platform\Transformers\UserTransformer;
use Platform\Transformers\RoleTransformer;
use Platform\Transformers\UserRoleTransformer;

class UserRoleController extends ApiController {

	protected $userTransformer;
	protected $roleTransformer;
	protected $userRoleTransformer;

	function __construct(UserTransformer $userTransformer,RoleTransformer $roleTransformer,UserRoleTransformer $userRoleTransformer)
    {
        $this->userTransformer = $userTransformer;
        $this->roleTransformer = $roleTransformer;
        $this->userRoleTransformer = $userRoleTransformer;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function roles($userId)
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

        return $this->respond(array_merge(array_merge($this->userTransformer->transform($user),['object'=> 'user.roles']),['user_roles' => [
            'object' => 'list',
            'data' => $this->roleTransformer->transformCollection($user->roles()->get()->toArray())]]));
	}



	public function users($roleId)
	{
		$validator = Validator::make(
            array('intRoleId' => $roleId),
            array('intRoleId' => 'required|alpha_num')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Role.');
        }
        if(is_numeric($roleId))
        {
        	//echo $role;
        	$role = Role::find($roleId);
        	//dd($roleObj);

        }
        else if(is_string($roleId))
        {
        	$role = Role::where('strRoleName','=',$roleId)->first();
    	}
        //$role = Role::find($roleId);

        if (!$role) {
            return $this->respondNotFound('Role does not exist.');
        }
        //return $role;
//return $role->users()->get();
        return $this->respond(array_merge(array_merge($this->roleTransformer->transform($role),['object'=> 'roles.user']),['roles_user' => [
            'object' => 'list',
            'data' => $this->userTransformer->transformCollection($role->users()->get()->toArray())]]));
	}


	public function authorize($userId, $roleId)
	{
		$validator = Validator::make(
            ['intUserId' => $userId,'intRoleId' => $roleId],
            ['intUserId' => 'required|numeric', 'intRoleId' => 'required']
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Inputs.');
        }
        $user = User::find($userId);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }
        DB::beginTransaction();
        $roles = explode(',',$roleId);
        foreach ($roles as $role) {
        	if(is_numeric($role))
	        {
	        	//echo $role;
	        	$roleObj = Role::find($role);
	        	//dd($roleObj);

	        }
	        else if(is_string($role))
	        {
	        	$roleObj = Role::where('strRoleName','=',$role)->first();
	    	}
//dd($roleObj);
	    	if($roleObj)
	    	{
	    		try{
	    				$user->roles()->attach($roleObj->intRoleId);
				}
				catch(\Exception $e)
		        {
		        	DB::rollback();
		            return $this->respondInternalError('Unable to authorize Role.');
		        }
	    	}
	    	else
	    	{
	    		DB::rollback();
	    		return $this->respondNotFound('Role does not exist.');
	    	}
        }
        DB::commit();
        return $this->respondOk('User role authorized.');
	}

	public function revoke($userId, $roleId)
	{
		$validator = Validator::make(
            ['intUserId' => $userId,'intRoleId' => $roleId],
            ['intUserId' => 'required|numeric', 'intRoleId' => 'required']
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Inputs.');
        }
        $user = User::find($userId);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }
        DB::beginTransaction();
        $roles = explode(',',$roleId);
        foreach ($roles as $role) {
        	if(is_numeric($role))
	        {
	        	//echo $role;
	        	$roleObj = Role::find($role);
	        	//dd($roleObj);

	        }
	        else if(is_string($role))
	        {
	        	$roleObj = Role::where('strRoleName','=',$role)->first();
	    	}
//dd($roleObj);
	    	if($roleObj)
	    	{
	    		try{
	    				$user->roles()->detach($roleObj->intRoleId);
				}
				catch(\Exception $e)
		        {
		        	DB::rollback();
		            return $this->respondInternalError('Unable to authorize Role.');
		        }
	    	}
	    	else
	    	{
	    		DB::rollback();
	    		return $this->respondNotFound('Role does not exist.');
	    	}
        }
        DB::commit();
        return $this->respondOk('User role revoked.');
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
