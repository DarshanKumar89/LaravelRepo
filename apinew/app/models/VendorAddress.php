<?php

/**
 * Class Debtor
 */
class VendorAddress extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'vendors_address';
    protected $primaryKey="intVendorAddressId";
    protected $softDelete = true;

    protected $fillable = [];
    protected $hidden = [];

    public function vendors()
    {
        return $this->belongsTo('Vendor');
    }
}