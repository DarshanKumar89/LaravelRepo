<?php

namespace Platform\Forms;


/**
 * Class Login
 * @package Platform\Forms
 */
class Login extends FormValidator {

    /**
     * @var array
     */
    protected $rules = [
                            'email' => 'required|email',
                            'password' => 'required'
                       ];

}