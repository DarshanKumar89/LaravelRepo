<?php
namespace Platform\Transformers;

/**
 * Class UserTransformer
 * @package Transformers
 */
class UserRoleTransformer extends Transformer
{

    /**
     * @param $user
     * @return array
     */
    public function transform($user)
    {
        return [
            'object' => 'user',
            'userId' => (int) $user['intUserId'],
            'userFname' => $user['strUserFname'],
            'userLname' => $user['strUserLname'],
            'userEmail' => $user['strUserEmail'],
            'userIsActive' => (boolean) $user['bolIsActive'],
            'created_at' => (int) strtotime($user['created_at']),
            'updated_at' => (int) strtotime($user['updated_at'])
        ];
    }

}