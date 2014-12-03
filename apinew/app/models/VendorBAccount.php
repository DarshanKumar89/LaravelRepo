<?php

/**
 * Class Debtor
 */
class VendorBAccount extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'vendors_baccount';
    protected $primaryKey="intVendorBaccountId";
    protected $softDelete = true;

    protected $fillable = [];
    protected $hidden = [];

    public function vendors()
    {
        return $this->belongsTo('Vendor');
    }
}