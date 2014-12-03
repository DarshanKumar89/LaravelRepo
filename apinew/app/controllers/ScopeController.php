<?php

use Platform\Transformers\ScopeTransformer;

class ScopeController extends ApiController {

	protected $scopeTransformer;

	function __construct(ScopeTransformer $scopeTransformer)
    {
        $this->scopeTransformer = $scopeTransformer;
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
		$scopes = Scope::paginate($limit);
        return $this->respondWithPagination($scopes,[
            'object' => 'list',
            'data' => $this->scopeTransformer->transformCollection($scopes->all())
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
                'scopeName' =>'required|unique:scopes,strScopeName|max:50',
                'scopeDesc' =>'required|max:200',
                'scopePerm' =>'required|numeric|min:0|max:15',
                'scopeIsActive' =>'required'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $scope = new Scope;
        $scope->strScopeName = Input::get('scopeName');
        $scope->strScopeDesc = Input::get('scopeDesc');
        $scope->intScopePerm = Input::get('scopePerm');
        $scope->bolIsActive = (Input::get('scopeIsActive')==='true') ? 1 : 0;
        try {
            $scope->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save Scope.');
        }
        $insertedScope = Scope::find($scope->intScopeId);

        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->scopeTransformer->transform($insertedScope));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($scopeId)
	{
		$validator = Validator::make(
            array('intScopeId' => $scopeId),
            array('intScopeId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Scope Id.');
        }
        $scope = Scope::find($scopeId);

        if (!$scope) {
            return $this->respondNotFound('Scope does not exist.');
        }
        return $this->respond( $this->scopeTransformer->transform($scope));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($scopeId)
	{
		Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(
            array('intScopeId' => $scopeId),
            array('intScopeId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Scope Id.');
        }

        $scope = Scope::find($scopeId);

        if (!$scope) {
            return $this->respondNotFound('Scope does not exist.');
        }

        $validator = Validator::make(
            Input::get(),
            array(
                'scopeName' =>'sometimes|alpha_dot|max:50',
                'scopeDesc' =>'sometimes|alpha_spaces|max:200',
                'scopePerm' =>'required|numeric|min:0|max:15',
                'scopeIsActive' =>'sometimes'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $scope->strScopeName = Input::get('scopeName')?Input::get('scopeName'):$scope->strScopeName;
        $scope->strScopeDesc = Input::get('scopeDesc')?Input::get('scopeDesc'):$scope->strScopeDesc;
        $scope->intScopePerm = Input::get('scopePerm')?Input::get('scopePerm'):$scope->strScopePerm;
        $scope->bolIsActive = Input::get('scopeIsActive')?((Input::get('scopeIsActive')==='true') ? 1 : 0):$scope->bolIsActive;
        try {
            $scope->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save Scope.');
        }
        $updatedScope = Scope::find($scopeId);

        return $this->setStatusCode(ApiController::HTTP_OK)->respond($this->scopeTransformer->transform($updatedScope));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($scopeId)
	{
		$validator = Validator::make(
            array('intScopeId' => $scopeId),
            array('intScopeId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Scope Id.');
        }
         $scope = Scope::withTrashed()->find($scopeId);

        if (!$scope) {
            return $this->respondNotFound('Scope does not exist.');
        }
        if ($scope->trashed()) {
            return $this->respondNotModified('Scope already deleted.');
        }

        try{

           $scope->delete();
 //        Delete other things also
        }
        catch (Exception $e)
        {
            return $this->respondInternalError('Unable to delete Scope.');
        }
        return $this->respondOk('Scope deleted.');
	}


}
