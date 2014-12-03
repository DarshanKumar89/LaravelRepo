<?php

class RemindersController extends ApiController {

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$user_email = Input::only('user_email')['user_email'];

		$user = User::where('strUserEmail','=',Input::get('user_email'))->where('bolIsActive','=','1')->first();
        
        if (!$user) {
            return $this->respondUnauthorizedError('User banned.');
        }

		$response = Password::remind(['strUserEmail' => $user_email], function($message)
		{
		    $message->subject('Password Reminder');
		    $message->sender('admin@sourceeasy.com');

		});

		switch ($response)
		{
			case Password::INVALID_USER: 
				return $this->respondBadRequest('Invalid User.');

			case Password::REMINDER_SENT: 
				return $this->respondOk('Reminder sent.');
		}
	}

	

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$user_email = Input::get('user_email');
		$password = Input::get('user_password');
		$token = Input::get('token');
		/*$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);*/

		$response = Password::reset(['strUserEmail' => $user_email,'password' => $password,'password_confirmation' => $password,'token' => $token ], function($user, $password)
		{
			$user->strUserPassword = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return $this->respondBadRequest('Invalid User.');

			case Password::PASSWORD_RESET:
				return $this->respondOk('Reminder reset.');
		}
	}

}
