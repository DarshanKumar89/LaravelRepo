<?php

class Oauth2Client extends Eloquent{

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'oauth2_clients';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	

    protected $primaryKey="intClientId";

    protected $dates = ['deleted_at'];

    // public function users()
    // {
    //     //return $this->belongsToMany('User','user_role','intUserId','intRoleId');
    //     return $this->belongsToMany('User','user_role','intRoleId','intUserId');
    // }

}
