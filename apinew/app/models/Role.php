<?php

class Role extends Eloquent{

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	

    protected $primaryKey="intRoleId";

    protected $dates = ['deleted_at'];

    public function users()
    {
        //return $this->belongsToMany('User','user_role','intUserId','intRoleId');
        return $this->belongsToMany('User','user_role','intRoleId','intUserId');
    }

}
