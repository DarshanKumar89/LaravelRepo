<?php

namespace Platform\Repositories;
use User;


class UserRepository extends EloquentRepository {

    protected $model;
    protected $thisUser;

    function __construct(User $model)
    {
        $this->model = $model;
        $this->thisUser = \Auth::user();
    }

    function activateUser($id)
    {
        $user = User::find($id);
        $user->activated       = 1;
        $user->activated_at    = new \DateTime();
        return $user->save();
    }

    function createCustomer($userObject)
    {
        $user = User::create([
                    'first_name' => $userObject->first_name,
                    'last_name' =>  $userObject-> last_name,
                    'email' =>      $userObject->email,
                    'password' =>   $userObject->password,
                    'activated' => 1,
                    'activated_at' => new \DateTime()
        ]);
        $user->roles()->attach(2); // Refactor this 2 is role_id for a admin user.
        return $user;
    }

    function login($userObject)
    {
        $message = "Invalid login or password.";
        $status = \Auth::attempt(['email' => $userObject->email, 'password' => $userObject->password],true);
        $response = [
            'status' => $status,
            'message' => $message
        ];
        if(\Auth::user()->banned == 1)
        {
            $this->logout();
            return  [
                'status' => false,
                'message' => "Your account is Banned, please contact support"
            ];
        }
        return  $response = [
            'status' => $status,
            'message' => $message
        ];
    }
    function isAdmin()
    {
        $user_roles = $this->thisUser->roles->toArray();
        for($i =0; $i< count($user_roles);$i++ )
        {
           if($user_roles[$i]['name'] == 'admin'){
               return true;
           }
        }
        return false;
    }

    function logout()
    {
        \Auth::logout();
    }

    function updateLastLogin()
    {
        $date = new \DateTime;
        $loggedinUser = \Auth::user();
        $loggedinUser->last_login = $date;
        $loggedinUser->save();
    }
}
