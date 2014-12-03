<?php

use Platform\Transformers\VendorTransformer;
use Platform\Transformers\VendorContactTransformer;

class VendorContactController extends ApiController {

	protected $vendorTransformer;
	protected $vendorContactTransformer;

	function __construct(VendorTransformer $vendorTransformer,VendorContactTransformer $vendorContactTransformer)
    {
        $this->vendorTransformer = $vendorTransformer;
        $this->vendorContactTransformer = $vendorContactTransformer;
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

        $vendorContact = $vendor->contacts;

        if (!$vendorContact) {
            return $this->respondNotFound('Vendor Contacts does not exist.');
        }

        return $this->respond([
            'object' => 'list',
            'data' => $this->vendorContactTransformer->transformCollection($vendorContact->all())
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
                'contactName' => 'required|max:200',
                'contactDesignation' => 'sometimes|max:200',
                'contactEmail' => 'sometimes|email|max:200',
                'contactPhone1' => 'sometimes|max:20',
                'contactPhone2' => 'sometimes|max:20'
            ));
        if ($validator->fails()) {
            return $this->respondBadRequest('Invalid input.', array('app_error' => $validator->messages()->toArray()));
        }

        $vendor = Vendor::find($vendorId);
        if (!$vendor) {
            return $this->respondNotFound('Vendor does not exist.');
        }

        $vendorContact = new VendorContact;
        $vendorContact->intVendorId = $vendorId;
        $vendorContact->strContactFullName =Input::get('contactName');
        $vendorContact->strContactDesgnation =Input::get('contactDesignation');
        $vendorContact->strContactEmail =Input::get('contactEmail');
        $vendorContact->strContactPhone1 =Input::get('contactPhone1');
        $vendorContact->strContactPhone2 =Input::get('contactPhone2');

        try {
            $vendorContact->save();
        } catch (\Exception $e) {
            return $this->respondInternalError('Unable to save Vendor contact.');
        }
        $insertedVendorContact = VendorContact::find($vendorContact->intVendorContactId);
        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->vendorContactTransformer->transform($insertedVendorContact));

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($vendorId, $vendorContactId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorContactId' => $vendorContactId),
            array('intVendorId'=>'required|numeric','intVendorContactId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid inputs.');
        }
        $vendorContact = VendorContact::find($vendorContactId);

        if (!$vendorContact) {
            return $this->respondNotFound('Vendor contact does not exist.');
        }
        if ($vendorContact->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and contact mismatch.');
        }

        return $this->respond( $this->vendorContactTransformer->transform($vendorContact));
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
	public function update($vendorId, $vendorContactId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorContactId' => $vendorContactId),
            array('intVendorId'=>'required|numeric','intVendorContactId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Inputs.');
        }
        $vendorContact = VendorContact::find($vendorContactId);

        if (!$vendorContact) {
            return $this->respondNotFound('Vendor contact does not exist.');
        }
        if ($vendorContact->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and contact mismatch.');
        }
        $validator = Validator::make(
            Input::get(),
            array(
                'contactName' => 'sometimes|alpha_spaces|max:200',
                'contactDesignation' => 'sometimes|alpha_spaces|max:200',
                'contactEmail' => 'sometimes|email|max:200',
                'contactPhone1' => 'sometimes|alpha_spaces|max:20',
                'contactPhone2' => 'sometimes|alpha_spaces|max:20'
            ));
        if ($validator->fails()) {
            return $this->respondBadRequest('Invalid input.', array('app_error' => $validator->messages()->toArray()));
        }

        $vendorContact->strContactFullName =Input::get('contactName')?Input::get('contactName'):$vendorContact->strContactFullName;
        $vendorContact->strContactDesgnation =Input::get('contactDesignation')?Input::get('contactDesignation'):$vendorContact->strContactDesgnation;
        $vendorContact->strContactEmail =Input::get('contactEmail')?Input::get('contactEmail'):$vendorContact->strContactEmail;
        $vendorContact->strContactPhone1 =Input::get('contactPhone1')?Input::get('contactPhone1'):$vendorContact->strContactPhone1;
        $vendorContact->strContactPhone2 =Input::get('contactPhone2')?Input::get('contactPhone2'):$vendorContact->strContactPhone2;

        try {
            $vendorContact->save();
        } catch (\Exception $e) {
            return $this->respondInternalError('Unable to save Vendor contact.');
        }
        $insertedVendorContact = VendorContact::find($vendorContact->intVendorContactId);
        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->vendorContactTransformer->transform($insertedVendorContact));


		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($vendorId, $vendorContactId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorContactId' => $vendorContactId),
            array('intVendorId'=>'required|numeric','intVendorContactId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Inputs.');
        }

        $vendorContact = VendorContact::withTrashed()->find($vendorContactId);
        if (!$vendorContact) {
            return $this->respondNotFound('Vendor contact does not exist.');
        }
        if ($vendorContact->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and contact mismatch.');
        }
        if ($vendorContact->trashed()) {
            return $this->respondNotModified('Vendor contact already deleted.');
        }

        try{

           $vendorContact->delete();
 //        Delete other things also
        }
        catch (Exception $e)
        {
            return $this->respondInternalError('Unable to delete Vendor contact.');
        }
        return $this->respondOk('Vendor contact deleted.');

		
	}


}
