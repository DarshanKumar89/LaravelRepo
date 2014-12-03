<?php
namespace Platform\Transformers;

/**
 * Class RoleTransformer
 * @package Transformers
 */
class ScopeTransformer extends Transformer
{

    /**
     * @param $role
     * @return array
     */
    public function transform($scope)
    {
        return [
            'object' => 'scope',
            'scopeId' => (int) $scope['intScopeId'],
            'scopeName' => $scope['strScopeName'],
            'scopeDesc' => $scope['strScopeDesc'],
            'scopePerm' => (int) $scope['strScopePerm'],
            'scopeIsActive' => (boolean) $scope['bolIsActive'],
            'created_at' => (int) strtotime($scope['created_at']),
            'updated_at' => (int) strtotime($scope['updated_at'])
        ];
    }

}