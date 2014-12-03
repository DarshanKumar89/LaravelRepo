<?php
namespace Platform\Transformers;

/**
 * Class RoleTransformer
 * @package Transformers
 */
class VendorTransformer extends Transformer
{

    /**
     * @param $role
     * @return array
     */
    public function transform($vendor)
    {
        return [
            'object' => 'vendor',
            'vendorId' => (int) $vendor['intVendorId'],
            'vendorName' => $vendor['strVendorName'],
            'vendorLocation' => $vendor['strVendorLocation'],
            'vendorType' => $vendor['intVendorType'],
            'vendorCategory' => $vendor['intVendorCategory'],
            'vendorCapacity' => $vendor['intVendorCapacity'],
            'vendorCompliance' => $vendor['strVendorCompliance'],
            'vendorIECCode' => $vendor['strVendorIECCode'],
            'vendorIsActive' => (boolean) $vendor['bolVendorIsActive'],
            'created_at' => (int) strtotime($vendor['created_at']),
            'updated_at' => (int) strtotime($vendor['updated_at'])
        ];
    }

}