<?php
namespace Platform\Transformers;

/**
 * Class RoleTransformer
 * @package Transformers
 */
class VendorContactTransformer extends Transformer
{

    /**
     * @param $role
     * @return array
     */
    public function transform($vendorContact)
    {
        return [
            'object' => 'vendorContact',
            'contactId' => (int) $vendorContact['intVendorContactId'],
            'contactName' => $vendorContact['strContactFullName'],
            'contactDesignation' => $vendorContact['strContactDesgnation'],
            'contactEmail' => $vendorContact['strContactEmail'],
            'contactPhone1' => $vendorContact['strContactPhone1'],
            'contactPhone2' => $vendorContact['strContactPhone2'],
            'created_at' => (int) strtotime($vendorContact['created_at']),
            'updated_at' => (int) strtotime($vendorContact['updated_at'])
        ];
    }

}