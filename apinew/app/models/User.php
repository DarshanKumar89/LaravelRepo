<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait;
	use SoftDeletingTrait;
	use RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	

    protected $primaryKey="intUserId";
    protected $dates = ['deleted_at'];

    public function getAuthPassword()
	{
	     return $this->attributes['strUserPassword'];
	}
	public function getReminderEmail() {
        return $this->strUserEmail;
    }

    public function roles()
    {
        return $this->belongsToMany('Role','user_role','intUserId','intRoleId');
    }

}
