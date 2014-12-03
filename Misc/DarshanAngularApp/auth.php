<?php

class Api_V1_Auth_Controller extends Base_Controller
{
  public function get_index()
	{
		try {
			$user = array();
			if (Auth::check()) {
				$user = Auth::user();
				$user->image = read_image($user->image);
			}

			if ($user)
				$user->password = null;

			$data = array(
				'user' => to_json($user),
			);

			return json($data);
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	public function get_logout()
	{
		try {
			return Auth::logout();
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	public function post_login()
	{
		try {
			$s = extend(array(
				'username' => '',
				'password' => '',
			), sr());

			if (! Auth::attempt($s))
				throw new Exception("Incorrect email or password.");

			if (Auth::user()->account_user_id == 0 || Auth::user()->deleted)
				throw new Exception("We can't find the account you are associated with.");

			$data = array(
				'success' => ''
			);

			return json($data);
		} catch(Exception $e) {
			Auth::logout();

			$data = array(
				'error' => $e->getMessage()
			);

			return json($data);
		}
	}

	public function post_register()
	{
		try {
			$s = extend(array(
				'serie_id' => 0,
				'name' => '',
				'email' => '',
				'password' => '',
				'terms' => '0',
			), sr());

			$v = Validator::make(array(
				'email' => $s['email'],
				'password' => $s['password'],
				'terms' => $s['terms'],
			), array(
				'email' => 'email|required|unique:users',
				'password' => 'required|min:6',
				'terms' => 'accepted|required',
			));

			if ($v->fails()) {
				foreach ($v->errors->messages as $key => $value) {
					$error = $value[0];
					break;
				}

				throw new Exception($error);
			}

			$user = User::create(array(
				'name' => $s['name'],
				'email' => $s['email'],
				'password' => Hash::make($s['password']),
				'type' => 'account',
				'perm_contacts' => 0,
			));

			$user->account_user_id = $user->id;
			$user->save();
			Auth::login($user->id, 1);

			$serie = Serie::find($s['serie_id']);
			if (! is_null($serie))
				if (! $serie->is_member($user->id) && ! $serie->is_expert($user->id))
					$serie->create_member($user->id);

			$data = array(
				'success' => true,
			);

			return json($data);
		} catch(Exception $e) {
			$data = array(
				'error' => $e->getMessage()
			);

			return json($data);
		}
	}

	public function get_locations()
	{
		try {
			$data = array(
				'locations' => to_json(Auth::user()->locations),
			);

			return json($data);
		} catch(Exception $e) {
			Report::log($e->getMessage());
		}
	}

	public function get_check()
	{
		try {
			$data = array(
				'check' => Auth::check(),
			);

			return json($data);
		} catch(Exception $e) {
			Report::log($e->getMessage());
		}
	}
}