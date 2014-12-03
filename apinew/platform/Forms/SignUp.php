<?php

namespace Platform\Forms;

/**
 * Class SignUp
 * @package Platform\Forms
 */
class SignUp extends FormValidator{

    /**
     * @var array
     */
    protected $rules =
    [
        'fist_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    ];
}