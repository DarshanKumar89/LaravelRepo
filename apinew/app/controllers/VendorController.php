<?php

use Platform\Transformers\VendorTransformer;

class VendorController extends ApiController {

	protected $vendorTransformer;

	function __construct(VendorTransformer $vendorTransformer)
    {
        $this->vendorTransformer = $vendorTransformer;
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
		$vendors = Vendor::paginate($limit);
        return $this->respondWithPagination($vendors,[
            'object' => 'list',
            'data' => $this->vendorTransformer->transformCollection($vendors->all())
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
                'vendorName' =>'required|max:200',
                'vendorLocation' =>'sometimes|max:200',
                'vendorType' =>'sometimes|numeric',
                'vendorCategory' =>'sometimes|numeric',
                'vendorCapacity' =>'sometimes|numeric',
                'vendorCompliance' =>'sometimes',
                'vendorIECCode' =>'sometimes',
                'vendorIsActive' =>'sometimes'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $vendor = new Vendor;
        $vendor->strVendorName = Input::get('vendorName');
        $vendor->strVendorLocation = Input::get('vendorLocation');
        $vendor->intVendorType = Input::get('vendorType');
        $vendor->intVendorCategory = Input::get('vendorCategory');
        $vendor->intVendorCapacity = Input::get('vendorCapacity');
        $vendor->strVendorCompliance = Input::get('vendorCompliance');
        $vendor->strVendorIECCode = Input::get('vendorIECCode');
        $vendor->bolVendorIsActive = (Input::get('vendorIsActive')==='true') ? 1 : 0;
        try {
            $vendor->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save Vendor.');
        }
        $insertedVendor = Vendor::find($vendor->intVendorId);

        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond($this->vendorTransformer->transform($insertedVendor));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($vendorId)
	{
		$validator = Validator::make(
            array('intVendorId' => $vendorId),
            array('intVendorId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Vendor Id.');
        }
        $vendor = Vendor::find($vendorId);

        if (!$vendor) {
            return $this->respondNotFound('Vendor does not exist.');
        }
        return $this->respond( $this->vendorTransformer->transform($vendor));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($vendorId)
	{
		Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make(
            array('intVendorId' => $vendorId),
            array('intVendorId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Vendor Id.');
        }

        $vendor = Vendor::find($vendorId);

        if (!$vendor) {
            return $this->respondNotFound('Vendor does not exist.');
        }

        $validator = Validator::make(
            Input::get(),
            array(
                'vendorName' =>'required|max:200',
                'vendorLocation' =>'sometimes|max:200',
                'vendorType' =>'sometimes|numeric',
                'vendorCategory' =>'sometimes|numeric',
                'vendorCapacity' =>'sometimes|numeric',
                'vendorCompliance' =>'sometimes|alpha_spaces',
                'vendorIECCode' =>'sometimes|alpha_spaces',
                'vendorIsActive' =>'sometimes'
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }
        $vendor->strVendorName = Input::get('vendorName')?Input::get('vendorName') : $vendor->strVendorName;
        $vendor->strVendorLocation = Input::get('vendorLocation')? Input::get('vendorLocation'): $vendor->strVendorLocation;
        $vendor->intVendorType = Input::get('vendorType')? Input::get('vendorType'): $vendor->intVendorType;
        $vendor->intVendorCategory = Input::get('vendorCategory')?Input::get('vendorCategory') : $vendor->intVendorCategory;
        $vendor->intVendorCapacity = Input::get('vendorCapacity')? Input::get('vendorCapacity'): $vendor->intVendorCapacity;
        $vendor->strVendorCompliance = Input::get('vendorCompliance')? Input::get('vendorCompliance'): $vendor->strVendorCompliance;
        $vendor->strVendorIECCode = Input::get('vendorIECCode')? Input::get('vendorIECCode'): $vendor->strVendorIECCode;
        $vendor->bolVendorIsActive = Input::get('vendorIsActive')?((Input::get('vendorIsActive')==='true') ? 1 : 0):$vendor->bolVendorIsActive;
        try {
            $vendor->save();
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save Vendor.');
        }
        $updatedVendor = Vendor::find($vendorId);

        return $this->setStatusCode(ApiController::HTTP_OK)->respond($this->vendorTransformer->transform($updatedVendor));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($vendorId)
	{
		$validator = Validator::make(
            array('intVendorId' => $vendorId),
            array('intVendorId' => 'required|numeric')
        );

        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid Vendor Id.');
        }
         $vendor = Vendor::withTrashed()->find($vendorId);

        if (!$vendor) {
            return $this->respondNotFound('Vendor does not exist.');
        }
        if ($vendor->trashed()) {
            return $this->respondNotModified('Vendor already deleted.');
        }

        try{

           $vendor->delete();
 //        Delete other things also
        }
        catch (Exception $e)
        {
            return $this->respondInternalError('Unable to delete Vendor.');
        }
        return $this->respondOk('Vendor deleted.');
	}


}
