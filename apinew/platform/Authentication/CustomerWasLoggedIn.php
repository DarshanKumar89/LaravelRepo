<?php
/**
 * Created by PhpStorm.
 * User: chiragchamoli
 * Date: 19/06/14
 * Time: 12:35 AM
 */

namespace Platform\Authentication;

use User;

class CustomerWasLoggedIn {
    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
}