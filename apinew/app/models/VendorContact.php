<?php

/**
 * Class Debtor
 */
class VendorContact extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'vendors_contact';
    protected $primaryKey="intVendorContactId";
    protected $softDelete = true;

    protected $fillable = [];
    protected $hidden = [];

    public function vendors()
    {
        return $this->belongsTo('Vendor');
    }
}