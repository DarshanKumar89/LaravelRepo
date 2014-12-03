<?php

class Scope extends Eloquent{

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'scopes';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	

    protected $primaryKey="intScopeId";

    protected $dates = ['deleted_at'];

}
