<?php

use Platform\Transformers\VendorTransformer;
use Platform\Transformers\VendorAddressTransformer;

class VendorAddressController extends ApiController {

	protected $vendorTransformer;
	protected $vendorAddressTransformer;

	function __construct(VendorTransformer $vendorTransformer,VendorAddressTransformer $vendorAddressTransformer)
    {
        $this->vendorTransformer = $vendorTransformer;
        $this->vendorAddressTransformer = $vendorAddressTransformer;
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

        $vendorAddress = $vendor->addresses;

        if (!$vendorAddress) {
            return $this->respondNotFound('Vendor Addresss does not exist.');
        }

        return $this->respond([
            'object' => 'list',
            'data' => $this->vendorAddressTransformer->transformCollection($vendorAddress->all())
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
                'addressLabel' => 'required|max:200',
                'addressLine1' => 'sometimes|max:200',
                'addressLine2' => 'sometimes|email|max:200',
                'addressCity' => 'sometimes|max:200',
                'addressState' => 'sometimes|max:20',
                'addressZip' => 'sometimes|max:20',
                'addressCountry' => 'sometimes|max:200'
            ));
        if ($validator->fails()) {
            return $this->respondBadRequest('Invalid input.', array('app_error' => $validator->messages()->toArray()));
        }

        $vendor = Vendor::find($vendorId);
        if (!$vendor) {
            return $this->respondNotFound('Vendor does not exist.');
        }

        $vendorAddress = new VendorAddress;
        $vendorAddress->intVendorId = $vendorId;
        $vendorAddress->strAddressLabel =Input::get('addressLabel');
        $vendorAddress->strAddressLine1 =Input::get('addressLine1');
        $vendorAddress->strAddressLine2 =Input::get('addressLine2');
        $vendorAddress->strAddressCity =Input::get('addressCity');
        $vendorAddress->strAddressState =Input::get('addressState');
        $vendorAddress->strAddressZip =Input::get('addressZip');
        $vendorAddress->strAddressCountry =Input::get('addressCountry');

        try {
            $vendorAddress->save();
        } catch (\Exception $e) {
            return $this->respondInternalError('Unable to save Vendor address.');
        }
        $insertedVendorAddress = VendorAddress::find($vendorAddress->intVendorAddressId);
        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->vendorAddressTransformer->transform($insertedVendorAddress));

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($vendorId, $vendorAddressId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorAddressId' => $vendorAddressId),
            array('intVendorId'=>'required|numeric','intVendorAddressId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid inputs.');
        }
        $vendorAddress = VendorAddress::find($vendorAddressId);

        if (!$vendorAddress) {
            return $this->respondNotFound('Vendor address does not exist.');
        }
        if ($vendorAddress->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and address mismatch.');
        }

        return $this->respond( $this->vendorAddressTransformer->transform($vendorAddress));
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
	public function update($vendorId, $vendorAddressId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorAddressId' => $vendorAddressId),
            array('intVendorId'=>'required|numeric','intVendorAddressId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Inputs.');
        }
        $vendorAddress = VendorAddress::find($vendorAddressId);

        if (!$vendorAddress) {
            return $this->respondNotFound('Vendor address does not exist.');
        }
        if ($vendorAddress->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and address mismatch.');
        }
        $validator = Validator::make(
            Input::get(),
            array(
                'addressLabel' => 'required|alpha_spaces|max:200',
                'addressLine1' => 'sometimes|alpha_spaces|max:200',
                'addressLine2' => 'sometimes|email|max:200',
                'addressCity' => 'sometimes|alpha_spaces|max:200',
                'addressState' => 'sometimes|alpha_spaces|max:20',
                'addressZip' => 'sometimes|alpha_spaces|max:20',
                'addressCountry' => 'sometimes|alpha_spaces|max:200'
            ));
        if ($validator->fails()) {
            return $this->respondBadRequest('Invalid input.', array('app_error' => $validator->messages()->toArray()));
        }

        $vendorAddress->strAddressLabel =Input::get('addressLabel')?Input::get('addressLabel'):$vendorAddress->strAddressLabel;
        $vendorAddress->strAddressLine1 =Input::get('addressLine1')?Input::get('addressLine1'):$vendorAddress->strAddressLine1;
        $vendorAddress->strAddressLine2 =Input::get('addressLine2')?Input::get('addressLine2'):$vendorAddress->strAddressLine2;
        $vendorAddress->strAddressCity =Input::get('addressCity')?Input::get('addressCity'):$vendorAddress->strAddressCity;
        $vendorAddress->strAddressState =Input::get('addressState')?Input::get('addressState'):$vendorAddress->strAddressState;
        $vendorAddress->strAddressZip =Input::get('addressZip')?Input::get('addressZip'):$vendorAddress->strAddressZip;
        $vendorAddress->strAddressCountry =Input::get('addressCountry')?Input::get('addressCountry'):$vendorAddress->strAddressCountry;
        
        try {
            $vendorAddress->save();
        } catch (\Exception $e) {
            return $this->respondInternalError('Unable to save Vendor address.');
        }
        $insertedVendorAddress = VendorAddress::find($vendorAddress->intVendorAddressId);
        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->vendorAddressTransformer->transform($insertedVendorAddress));


		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($vendorId, $vendorAddressId)
	{
		$validator = Validator::make(
            array('intVendorId'=>$vendorId,'intVendorAddressId' => $vendorAddressId),
            array('intVendorId'=>'required|numeric','intVendorAddressId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Inputs.');
        }

        $vendorAddress = VendorAddress::withTrashed()->find($vendorAddressId);
        if (!$vendorAddress) {
            return $this->respondNotFound('Vendor address does not exist.');
        }
        if ($vendorAddress->intVendorId != $vendorId) {
            return $this->respondBadRequest('Vendor and address mismatch.');
        }
        if ($vendorAddress->trashed()) {
            return $this->respondNotModified('Vendor address already deleted.');
        }

        try{

           $vendorAddress->delete();
 //        Delete other things also
        }
        catch (Exception $e)
        {
            return $this->respondInternalError('Unable to delete Vendor address.');
        }
        return $this->respondOk('Vendor address deleted.');

		
	}


}
