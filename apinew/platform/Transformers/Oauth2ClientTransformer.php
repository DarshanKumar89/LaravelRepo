<?php
namespace Platform\Transformers;


/**
 * Class UserTransformer
 * @package Transformers
 */
class Oauth2ClientTransformer extends Transformer
{

    /**
     * @param $user
     * @return array
     */
    public function transform($oauth2Client)
    {
        return [
            'object' => 'oauth2_client',
            'client_id' => (int) $oauth2Client['intClientId'],
            'user_id' => $oauth2Client['intUserId'],
            'client_key' => $oauth2Client['strClientKey'],
            'client_secret' => $oauth2Client['strClientSecret'],
            'redirect_uri' => $oauth2Client['strRedirectUri'],
            'grant_type' =>  $oauth2Client['strGrantType'],
            'created_at' => (int) strtotime($oauth2Client['created_at']),
            'updated_at' => (int) strtotime($oauth2Client['updated_at'])
        ];
    }

}