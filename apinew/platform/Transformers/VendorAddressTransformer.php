<?php
namespace Platform\Transformers;

/**
 * Class RoleTransformer
 * @package Transformers
 */
class VendorAddressTransformer extends Transformer
{

    /**
     * @param $role
     * @return array
     */
    public function transform($vendorAddress)
    {
        return [
            'object' => 'vendorAddress',
            'addressId' => (int) $vendorAddress['intVendorAddressId'],
            'addressLabel' => $vendorAddress['strAddressLabel'],
            'addressLine1' => $vendorAddress['strAddressLine1'],
            'addressLine2' => $vendorAddress['strAddressLine2'],
            'addressCity' => $vendorAddress['strAddressCity'],
            'addressState' => $vendorAddress['strAddressState'],
            'addressZip' => $vendorAddress['strAddressZip'],
            'addressCountry' => $vendorAddress['strAddressCountry'],
            'created_at' => (int) strtotime($vendorAddress['created_at']),
            'updated_at' => (int) strtotime($vendorAddress['updated_at'])
        ];
    }

}