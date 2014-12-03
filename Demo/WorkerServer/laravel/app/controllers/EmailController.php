<?php

class EmailController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
            Input::get(),
            array(
                'from' =>'required|email',
                'to' =>'required|email',
                'cc' =>'sometimes|email',
                'bcc' =>'sometimes|email',
                'subject' =>'required|alpha_spaces|max:200',
                'text' =>'sometimes',
                'html' =>'sometimes',
                'attachment_list' =>'sometimes',
                'inline_image' =>'sometimes',
            ));
        if($validator->fails())
        {
            return $this->respondBadRequest('Invalid input.',array('app_error'=>$validator->messages()->toArray()));
        }

        $email = new Email;

		$from = Input::get('from');
        $to = Input::get('to');
        $cc = Input::get('cc');
        $bcc = Input::get('bcc');
        $subject = Input::get('subject');
        $text = Input::get('text');
        $html = Input::get('html');
        $attachmentList = \Input::file('file');
        $inlineImage = Input::get('inline_image');

		try {
            $result = $email->sendEmail($from,$to,$cc,$bcc,$subject,$text,$html,$attachmentList,$inlineImage);
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to save Role.');
        }

        return $this->setStatusCode(ApiController::HTTP_CREATED)->respond('Email added to Queue');
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
