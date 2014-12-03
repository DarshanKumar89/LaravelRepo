<?php

class Vendor extends Eloquent{

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vendors';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	

    protected $primaryKey="intVendorId";

    protected $dates = ['deleted_at'];

    public function contacts()
    {
        return $this->hasMany('VendorContact','intVendorId');
    }
    public function addresses()
    {
        return $this->hasMany('VendorAddress','intVendorId');
    }
    public function baccounts()
    {
        return $this->hasMany('VendorBAccount','intVendorId');
    }

}
