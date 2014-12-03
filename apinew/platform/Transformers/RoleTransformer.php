<?php
namespace Platform\Transformers;

/**
 * Class RoleTransformer
 * @package Transformers
 */
class RoleTransformer extends Transformer
{

    /**
     * @param $role
     * @return array
     */
    public function transform($role)
    {
        return [
            'object' => 'role',
            'roleId' => (int) $role['intRoleId'],
            'roleName' => $role['strRoleName'],
            'roleDesc' => $role['strRoleDesc'],
            'roleIsActive' => (boolean) $role['bolIsActive'],
            'created_at' => (int) strtotime($role['created_at']),
            'updated_at' => (int) strtotime($role['updated_at'])
        ];
    }

}