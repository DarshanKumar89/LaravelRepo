<?php
/**
 * Created by PhpStorm.
 * User: chiragchamoli
 * Date: 19/06/14
 * Time: 12:16 AM
 */

namespace Platform\Authentication;


class LoginCommand {

    public $email;
    public $password;

    function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

}