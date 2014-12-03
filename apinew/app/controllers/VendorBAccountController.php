<?php

use Platform\Transformers\VendorTransformer;
use Platform\Transformers\VendorBAccountTransformer;

class VendorBAccountController extends ApiController {

	protected $vendorTransformer;
	protected $vendorBAccountTransformer;

	function __construct(VendorTransformer $vendorTransformer,VendorBAccountTransformer $vendorBAccountTransformer)
    {
        $this->vendorTransformer = $vendorTransformer;
        $this->vendorBAccountTransformer = $vendorBAccountTransformer;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($vendorId)
	{
		$validator = Validator::make(
            array('intVendorId' => $vendorId),
            array('intVendorId' => 'required|numeric')
        );

        if ($validator->fails()) {
            return $this->respondBadRequest('Invalid Vendor Id.');
        }

        $vendor = Vendor::find($vendorId);

        if (!$vendor) {
            return $this->respondNotFound('Vendor does not exist.');
        }

        $vendorBAccount = $vendor->baccounts;

        if (!$vendorBAccount) {
            return $this->respondNotFound('Vendor Bank Accounts does not exist.');
        }

        return $this->respond([
            'object' => 'list',
            'data' => $this->vendorBAccountTransformer->transformCollection($vendorBAccount->all())
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
	public function store($vendorId)
	{
		Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(
            array('intVendorId' => $vendorId),
            array('intVendorId' => 'required')
        );

        if ($validator->fails()) {
            return $this->respondBadRequest('Invalid Vendor Id.');
        }

        $validator = Validator::make(
            Input::get(),
            array(
                'bAccountBank' => 'required|max:200',
                'bAccountName' => 'sometimes|max:200',
                'bAccountNumber' => 'sometimes|numeric',
                'bAccountBranch' => 'sometimes|max:200',
                'bAccountIFSC' => 'sometimes|max:20',
                'bAccountType' => 'sometimes|max:20'
                ));
        if ($validator->fails()) {
            return $this->respondBadRequest('Invalid input.', array('app_error' => $validator->messages()->toArray()));
        }

        $vendor = Vendor::find($vendorId);
        if (!$vendor) {
            return $this->respondNotFound('Vendor does not exist.');
        }

        $vendorBAccount = new VendorBAccount;
        $vendorBAccount->intVendorId = $vendorId;
        $vendorBAccount->strBaccountBank =Input::get('bAccountBank');
        $vendorBAccount->strBaccountName =Input::get('bAccountName');
        $vendorBAccount->intBaccountNumber =Input::get('bAccountNumber');
        $vendorBAccount->strBaccountBranch =Input::get('bAccountBranch');
        $vendorBAccount->strBaccountIFSC =Input::get('bAccountIFSC');
        $vendorBAccount->strBaccountType =Input::get('bAccountType');
        try {
            $vendorBAccount->save();
        } catch (\Exception $e) {
            return $this->respondInternalError('Unable to save Vendor bank account.');
        }
        $insertedVendorBAccount = VendorBAccount::find($vendorBAccount->intVendorBaccountId);
        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->vendorBAccountTransformer->transform($insertedVendorBAccount));

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($vendorId, $vendorBAccountId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorBAccountId' => $vendorBAccountId),
            array('intVendorId'=>'required|numeric','intVendorBAccountId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid inputs.');
        }
        $vendorBAccount = VendorBAccount::find($vendorBAccountId);

        if (!$vendorBAccount) {
            return $this->respondNotFound('Vendor Bank account does not exist.');
        }
        if ($vendorBAccount->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and Bank account mismatch.');
        }

        return $this->respond( $this->vendorBAccountTransformer->transform($vendorBAccount));
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
	public function update($vendorId, $vendorBAccountId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorBAccountId' => $vendorBAccountId),
            array('intVendorId'=>'required|numeric','intVendorBAccountId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Inputs.');
        }
        $vendorBAccount = VendorBAccount::find($vendorBAccountId);

        if (!$vendorBAccount) {
            return $this->respondNotFound('Vendor Bank account does not exist.');
        }
        if ($vendorBAccount->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and Bank account mismatch.');
        }
        $validator = Validator::make(
            Input::get(),
            array(
                'bAccountBank' => 'required|alpha_spaces|max:200',
                'bAccountName' => 'sometimes|alpha_spaces|max:200',
                'bAccountNumber' => 'sometimes|numeric',
                'bAccountBranch' => 'sometimes|alpha_spaces|max:200',
                'bAccountIFSC' => 'sometimes|alpha_spaces|max:20',
                'bAccountType' => 'sometimes|alpha_spaces|max:20'
                ));
        if ($validator->fails()) {
            return $this->respondBadRequest('Invalid input.', array('app_error' => $validator->messages()->toArray()));
        }

        $vendorBAccount->strBaccountBank =Input::get('bAccountBank')?Input::get('bAccountBank'):$vendorBAccount->strBaccountBank;
        $vendorBAccount->strBaccountName =Input::get('bAccountName')?Input::get('bAccountName'):$vendorBAccount->strBaccountName;
        $vendorBAccount->intBaccountNumber =Input::get('bAccountNumber')?Input::get('bAccountNumber'):$vendorBAccount->intBaccountNumber;
        $vendorBAccount->strBaccountBranch =Input::get('bAccountBranch')?Input::get('bAccountBranch'):$vendorBAccount->strBaccountBranch;
        $vendorBAccount->strBaccountIFSC =Input::get('bAccountIFSC')?Input::get('bAccountIFSC'):$vendorBAccount->strBaccountIFSC;
        $vendorBAccount->strBaccountType =Input::get('bAccountType')?Input::get('bAccountType'):$vendorBAccount->strBaccountType;        
        try {
            $vendorBAccount->save();
        } catch (\Exception $e) {
            return $this->respondInternalError('Unable to save Vendor Bank account .');
        }
        $insertedVendorBAccount = VendorBAccount::find($vendorBAccount->intVendorBaccountId);
        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->vendorBAccountTransformer->transform($insertedVendorBAccount));


		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($vendorId, $vendorBAccountId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorBAccountId' => $vendorBAccountId),
            array('intVendorId'=>'required|numeric','intVendorBAccountId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Inputs.');
        }

        $vendorBAccount = VendorBAccount::withTrashed()->find($vendorBAccountId);
        if (!$vendorBAccount) {
            return $this->respondNotFound('Vendor Bank account does not exist.');
        }
        if ($vendorBAccount->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and Bank account mismatch.');
        }
        if ($vendorBAccount->trashed()) {
            return $this->respondNotModified('Vendor Bank account already deleted.');
        }

        try{

           $vendorBAccount->delete();
 //        Delete other things also
        }
        catch (Exception $e)
        {
            return $this->respondInternalError('Unable to delete Vendor Bank account .');
        }
        return $this->respondOk('Vendor Bank account deleted.');

		
	}


}
