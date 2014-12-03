<?php
namespace Platform\Transformers;

/**
 * Class RoleTransformer
 * @package Transformers
 */
class VendorBAccountTransformer extends Transformer
{

    /**
     * @param $role
     * @return array
     */
    public function transform($vendorBAccount)
    {
        return [
            'object' => 'vendorBAccount',
            'bAccountId' => (int) $vendorBAccount['intVendorBaccountId'],
            'bAccountBank' => $vendorBAccount['strBaccountBank'],
            'bAccountName' => $vendorBAccount['strBaccountName'],
            'bAccountNumber' => (int)$vendorBAccount['intBaccountNumber'],
            'bAccountBranch' => $vendorBAccount['strBaccountBranch'],
            'bAccountIFSC' => $vendorBAccount['strBaccountIFSC'],
            'bAccountType' => $vendorBAccount['strBaccountType'],
            'created_at' => (int) strtotime($vendorBAccount['created_at']),
            'updated_at' => (int) strtotime($vendorBAccount['updated_at'])
        ];
    }

}